@extends('admin.master_layout.main')

@section('title', 'Chỉnh sửa mã giảm giá: ' . $coupon->coupon_code)

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa mã giảm giá: {{ $coupon->coupon_code }}</h1>
            <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- Form -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.coupon.update', $coupon) }}" method="POST" id="editCouponForm">
                    @csrf
                    @method('PUT') {{-- Sử dụng phương thức PUT cho cập nhật --}}

                    <!-- Coupon Details -->
                    <div class="form-section mb-4">
                        <h5 class="section-title">Thông tin mã giảm giá</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coupon_code" class="form-label">Mã giảm giá <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                        id="coupon_code" name="coupon_code"
                                        value="{{ old('coupon_code', $coupon->coupon_code) }}" required>
                                    @error('coupon_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_type" class="form-label">Loại giảm giá <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('discount_type') is-invalid @enderror"
                                        id="discount_type" name="discount_type" required>
                                        <option value="">Chọn loại giảm giá</option>
                                        <option value="Percentage"
                                            {{ old('discount_type', $coupon->discount_type) == 'Percentage' ? 'selected' : '' }}>
                                            Phần trăm (%)</option>
                                        <option value="Fixed Amount"
                                            {{ old('discount_type', $coupon->discount_type) == 'Fixed Amount' ? 'selected' : '' }}>
                                            Số tiền cố định (VNĐ)</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_value" class="form-label">Giá trị giảm giá <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('discount_value') is-invalid @enderror"
                                        id="discount_value" name="discount_value"
                                        value="{{ old('discount_value', $coupon->discount_value) }}" required>
                                    @error('discount_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_order_amount" class="form-label">Giá trị đơn hàng tối thiểu</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('min_order_amount') is-invalid @enderror"
                                        id="min_order_amount" name="min_order_amount"
                                        value="{{ old('min_order_amount', $coupon->min_order_amount) }}">
                                    @error('min_order_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="usage_limit_per_user" class="form-label">Giới hạn sử dụng / người
                                        dùng</label>
                                    <input type="number"
                                        class="form-control @error('usage_limit_per_user') is-invalid @enderror"
                                        id="usage_limit_per_user" name="usage_limit_per_user"
                                        value="{{ old('usage_limit_per_user', $coupon->usage_limit_per_user) }}"
                                        placeholder="Để trống nếu không giới hạn">
                                    @error('usage_limit_per_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total_usage_limit" class="form-label">Tổng giới hạn sử dụng</label>
                                    <input type="number"
                                        class="form-control @error('total_usage_limit') is-invalid @enderror"
                                        id="total_usage_limit" name="total_usage_limit"
                                        value="{{ old('total_usage_limit', $coupon->total_usage_limit) }}"
                                        placeholder="Để trống nếu không giới hạn">
                                    @error('total_usage_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Ngày bắt đầu <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                        class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                        name="start_date"
                                        value="{{ old('start_date', $coupon->start_date ? $coupon->start_date->format('Y-m-d\TH:i') : '') }}"
                                        required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Ngày hết hạn <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                        class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                                        name="end_date"
                                        value="{{ old('end_date', $coupon->end_date ? $coupon->end_date->format('Y-m-d\TH:i') : '') }}"
                                        required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Hoạt động</label>
                            @error('is_active')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Cập nhật mã giảm giá
                        </button>
                        <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/css/coupons/edit.css') }}"> --}}
@endpush

@push('scripts')
    {{-- Có thể thêm JS cho date/time picker ở đây nếu cần --}}
    {{-- <script src="{{ asset('assets/admin/js/coupons/edit.js') }}"></script> --}}
@endpush
