<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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

            // Tính tổng tiền
            $totalAmount = collect($cart)->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            // Tạo đơn hàng
            $order = Order::create([
                'order_id'         => Str::uuid(),
                'user_id'          => $user->user_id,
                'order_date'       => now(),
                'total_amount'     => $totalAmount,
                'shipping_address' => $user->address,
                'billing_address'  => $user->address,
                'phone_number'     => $user->phone_number,
                'order_status'     => 'Pending',
                'payment_method'   => $request->input('payment_method', 'cod'),
                'payment_status'   => 'Unpaid',
                'notes'            => $request->input('notes'),
            ]);

            // Lưu từng item vào bảng order_items
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_item_id'   => Str::uuid(),
                    'order_id'        => $order->order_id,
                    'product_id'      => $productId,
                    'quantity'        => $item->quantity,
                    'price_per_item'  => $item->price,
                ]);
            }

            $paymentMethod = $request->input('payment_method', 'cod');
            DB::commit();
            session()->forget('cart');

            if ($paymentMethod === 'momo') {
                // Mô phỏng trang thanh toán MoMo
                return view('user.page.payment_demo', ['order' => $order]);
            }

            return redirect()->route('checkout.success', ['id' => $order->order_id])
                ->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi khi đặt hàng: ' . $e->getMessage());
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
}
