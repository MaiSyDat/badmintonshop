<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductExtend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.page.checkout', compact('cart'));
    }


    public function process(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        try {
            $user = Auth::user();

            // Nếu thiếu thông tin người dùng thì validate và cập nhật
            if (!$user->phone_number || !$user->address || !$user->full_name) {
                $request->validate([
                    'fullname' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:20',
                    'address' => 'required|string|max:255',
                ], [
                    'fullname.required' => 'Vui lòng nhập họ tên.',
                    'phone_number.required' => 'Vui lòng nhập số điện thoại.',
                    'address.required' => 'Vui lòng nhập địa chỉ.',
                ]);

                $user->update([
                    'full_name'     => $request->input('fullname'),
                    'phone_number'  => $request->input('phone_number'),
                    'address'       => $request->input('address'),
                ]);
            }

            // Tính tổng tiền ban đầu
            $totalAmount = collect($cart)->sum(fn($item) => $item->quantity * $item->price);
            $discount = 0;

            // Tính giảm giá nếu có mã hợp lệ
            if (session()->has('applied_coupon')) {
                $couponData = session('applied_coupon');
                $coupon = \App\Models\Coupon::find($couponData['coupon_id']);

                if ($coupon && $coupon->is_active && now()->between($coupon->start_date, $coupon->end_date)) {
                    if ($totalAmount >= $coupon->min_order_amount) {
                        $discount = $coupon->discount_type === 'Percentage'
                            ? $totalAmount * ($coupon->discount_value / 100)
                            : $coupon->discount_value;

                        $discount = min($discount, $totalAmount); // Không để âm
                    }
                }
            }

            // Tính tổng tiền sau giảm
            $finalAmount = $totalAmount - $discount;

            // Tạo đơn hàng
            $order = Order::create([
                'order_id'         => Str::uuid(),
                'user_id'          => $user->user_id,
                'order_date'       => now(),
                'total_amount'     => $finalAmount,
                'shipping_address' => $user->address,
                'billing_address'  => $user->address,
                'phone_number'     => $user->phone_number,
                'order_status'     => 'Pending',
                'payment_method'   => $request->input('payment_method', 'cod'),
                'payment_status'   => 'Unpaid',
                'notes'            => $request->input('notes'),
            ]);

            // Lưu thông tin mã giảm giá nếu có
            if (session()->has('applied_coupon')) {
                \App\Models\AppliedCoupon::create([
                    'applied_coupon_id' => Str::uuid(),
                    'order_id'          => $order->order_id,
                    'coupon_id'         => $couponData['coupon_id'],
                    'discount_amount'   => $discount,
                ]);
            }

            // Lưu các sản phẩm vào bảng order_items
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_item_id'   => Str::uuid(),
                    'order_id'        => $order->order_id,
                    'product_id'      => $productId,
                    'quantity'        => $item->quantity,
                    'price_per_item'  => $item->price,
                ]);

                // Trừ tồn kho
                $productExtend = ProductExtend::where('product_id', $productId)->first();
                if ($productExtend) {
                    if ($productExtend->quantity < $item->quantity) {
                        throw new \Exception("Sản phẩm {$item->name} không đủ số lượng tồn kho.");
                    }
                    $productExtend->decrement('quantity', $item->quantity);
                }
            }

            DB::commit();

            // Xóa session giỏ hàng và mã giảm giá
            session()->forget('cart');
            session()->forget('applied_coupon');

            // Điều hướng thanh toán
            $paymentMethod = $request->input('payment_method', 'cod');
            if ($paymentMethod === 'momo') {
                return view('user.page.payment_demo', ['order' => $order]);
            }

            return redirect()->route('checkout.success', ['id' => $order->order_id])
                ->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xử lý đơn hàng. Vui lòng thử lại sau.');
        }
    }

    // CheckOutController.php
    public function confirmMomo($id)
    {
        $order = Order::where('order_id', $id)->firstOrFail();
        $order->update([
            'payment_status' => 'Paid',
            'order_status' => 'Confirmed',
        ]);

        return redirect()->route('checkout.success', ['id' => $order->order_id])
            ->with('success', 'Đã thanh toán MoMo thành công!');
    }

    public function showOrder($id)
    {
        $order = Order::with(['orderItems.product'])->findOrFail($id);

        return view('user.page.success', compact('order'));
    }

    public function cancelOrder($id)
    {
        $order = Order::where('order_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (in_array($order->order_status, ['Cancelled', 'Delivered'])) {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng đã giao hoặc đã hủy.');
        }

        $order->update([
            'order_status' => 'Cancelled',
        ]);

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
    }
}
