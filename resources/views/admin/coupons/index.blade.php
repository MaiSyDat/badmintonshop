@extends('admin.master_layout.main')

@section('title', 'Quản lý Mã giảm giá')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quản lý Mã giảm giá</h1>
            <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Thêm Mã giảm giá
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.coupon.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search"
                                placeholder="Tìm kiếm theo mã giảm giá..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="discount_type">
                            <option value="">Tất cả loại giảm giá</option>
                            <option value="Percentage" {{ request('discount_type') == 'Percentage' ? 'selected' : '' }}>Phần
                                trăm</option>
                            <option value="Fixed Amount" {{ request('discount_type') == 'Fixed Amount' ? 'selected' : '' }}>
                                Số tiền cố định</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" name="status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" name="expiry_status">
                            <option value="">Trạng thái hết hạn</option>
                            <option value="active" {{ request('expiry_status') == 'active' ? 'selected' : '' }}>Còn hạn
                            </option>
                            <option value="expired" {{ request('expiry_status') == 'expired' ? 'selected' : '' }}>Hết hạn
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Lọc
                        </button>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <a href="{{ route('admin.coupon.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle me-2"></i>Xóa lọc
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Coupon List -->
        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã giảm giá</th>
                                <th>Loại giảm giá</th>
                                <th>Giá trị</th>
                                <th>Đơn hàng tối thiểu</th>
                                <th>Giới hạn/User</th>
                                <th>Tổng giới hạn</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày hết hạn</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $key => $coupon)
                                <tr>
                                    <td>{{ $coupons->firstItem() + $key }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->discount_type }}</td>
                                    <td>
                                        {{ number_format($coupon->discount_value, 0, ',', '.') }}
                                        @if ($coupon->discount_type === 'Percentage')
                                            %
                                        @else
                                            VNĐ
                                        @endif
                                    </td>
                                    <td>{{ number_format($coupon->min_order_amount, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ $coupon->usage_limit_per_user ?? 'Không giới hạn' }}</td>
                                    <td>{{ $coupon->total_usage_limit ?? 'Không giới hạn' }}</td>
                                    <td>{{ $coupon->start_date->format('d/m/Y H:i') }}</td>
                                    <td>{{ $coupon->end_date->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if ($coupon->is_active)
                                            <span class="badge bg-success">Đang hoạt động</span>
                                        @else
                                            <span class="badge bg-secondary">Đã ẩn</span>
                                        @endif
                                        @if ($coupon->end_date < now() && $coupon->is_active)
                                            <span class="badge bg-danger ms-1">Hết hạn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.coupon.edit', $coupon) }}"
                                                class="btn btn-sm btn-primary" title="Sửa">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.coupon.destroy', $coupon->coupon_id) }}"
                                                method="POST" class="d-inline ms-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này không?');">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="bi bi-emoji-frown fs-1"></i>
                                            <p class="mt-2">Không tìm thấy mã giảm giá nào</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Bạn có thể thêm CSS riêng tại đây --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/css/coupons/index.css') }}"> --}}
@endpush

@push('scripts')
    {{-- Nếu bạn muốn dùng fetch API cho delete thay vì form submit --}}
    {{--
    <script>
        function deleteCoupon(couponId) {
            if (confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')) {
                fetch(`/admin/coupon/${couponId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi xóa mã giảm giá');
                    });
            }
        }
    </script>
    --}}
@endpush
