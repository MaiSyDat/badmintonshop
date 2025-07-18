<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CouponApplyController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $couponCode = trim($request->coupon_code);

        $coupon = Coupon::where('coupon_code', $couponCode)
            ->where('is_active', 1)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if (!$coupon) {
            return back()->withErrors(['coupon_code' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.']);
        }

        $cartTotal = session('cart_total', 0);

        if ($cartTotal < $coupon->min_order_amount) {
            return back()->withErrors(['coupon_code' => 'Đơn hàng chưa đủ điều kiện áp dụng mã.']);
        }

        $discount = 0;
        if ($coupon->discount_type === 'Percentage') {
            $discount = $cartTotal * ($coupon->discount_value / 100);
        } else {
            $discount = $coupon->discount_value;
        }

        $discount = min($discount, $cartTotal);

        Session::put('applied_coupon', [
            'coupon_id' => $coupon->coupon_id,
            'code' => $coupon->coupon_code,
            'discount_amount' => $discount,
        ]);
        return back()->with('discount_amount', $discount);
    }
}
