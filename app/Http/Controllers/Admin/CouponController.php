<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Danh sách mã giảm giá
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        // Tìm kiếm theo mã giảm giá
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('coupon_code', 'like', "%{$search}%");
        }

        // Lọc theo loại giảm giá
        if ($request->has('discount_type') && !empty($request->discount_type)) {
            $query->where('discount_type', $request->discount_type);
        }

        // Lọc theo trạng thái
        if ($request->has('status') && in_array($request->status, ['0', '1'])) {
            $query->where('is_active', $request->status);
        }

        // chỉ lấy các mã còn hạn
        if ($request->has('expiry_status') && $request->expiry_status == 'active') {
            $query->where('end_date', '>=', now());
        } elseif ($request->has('expiry_status') && $request->expiry_status == 'expired') {
            $query->where('end_date', '<', now());
        }


        $coupons = $query->paginate(10)->withQueryString();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage (Lưu mã giảm giá mới).
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coupon_code' => 'required|string|max:50|unique:coupons,coupon_code',
            'discount_type' => 'required|in:Percentage,Fixed Amount',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'total_usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ngày kết thúc phải sau hoặc bằng ngày bắt đầu
            'is_active' => 'boolean',
        ]);

        Coupon::create($validatedData);

        return redirect()->route('admin.coupon.index')->with('success', 'Mã giảm giá đã được tạo thành công!');
    }

    /**
     * Show the form for editing the specified resource (Hiển thị form chỉnh sửa).
     */
    public function edit(Coupon $coupon) // Route Model Binding
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage (Cập nhật mã giảm giá).
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validatedData = $request->validate([
            // Mã giảm giá phải duy nhất, nhưng bỏ qua chính coupon hiện tại
            'coupon_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('coupons', 'coupon_code')->ignore($coupon->coupon_id, 'coupon_id'),
            ],
            'discount_type' => 'required|in:Percentage,Fixed Amount',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'total_usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $coupon->update($validatedData);

        return redirect()->route('admin.coupon.index')->with('success', 'Mã giảm giá đã được cập nhật thành công!');
    }

    /**
     * Remove
     */
    public function destroy(Coupon $coupon)
    {

        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Mã giảm giá đã được xóa thành công!');
    }
}
