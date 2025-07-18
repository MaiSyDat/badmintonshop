@extends('admin.master_layout.main')

@section('title', 'Quản lý đơn hàng')

@section('main')
    <div class="col-md-12 main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý Đơn hàng</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Đơn hàng</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Bộ lọc -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Tìm theo số ĐH, SĐT, tên..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="order_status" class="form-select">
                            <option value="">Tất cả trạng thái đơn</option>
                            <option value="Pending" {{ request('order_status') == 'Pending' ? 'selected' : '' }}>Chờ xử lý
                            </option>
                            <option value="Confirmed" {{ request('order_status') == 'Confirmed' ? 'selected' : '' }}>Đã xác
                                nhận</option>
                            <option value="Shipped" {{ request('order_status') == 'Shipped' ? 'selected' : '' }}>Đã giao
                            </option>
                            <option value="Cancelled" {{ request('order_status') == 'Cancelled' ? 'selected' : '' }}>Đã hủy
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="payment_status" class="form-select">
                            <option value="">Tất cả thanh toán</option>
                            <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Đã thanh toán
                            </option>
                            <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>Chưa thanh
                                toán</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Lọc</button>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle me-2"></i>Xóa lọc
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh sách đơn hàng -->
        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn</th>
                                <th>Người đặt</th>
                                <th>Ngày đặt</th>
                                <th>Giá trị</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->user->full_name ?? 'Không có tên' }}<br><small>{{ $order->phone_number }}</small>
                                    </td>
                                    <td>{{ $order->order_date->format('d/m/Y H:i') }}</td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $order->payment_status == 'Paid' ? 'success' : 'warning' }}">
                                            {{ $order->payment_status == 'Paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                        </span>
                                    </td>
                                    @php
                                        $isFinalStatus = in_array($order->order_status, [
                                            'Cancelled',
                                            'Delivered',
                                            'Shipped',
                                        ]);
                                    @endphp

                                    <td>
                                        <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}"
                                            method="POST" onchange="this.submit()">
                                            @csrf
                                            @method('PATCH')
                                            <select name="order_status" class="form-select form-select-sm"
                                                {{ $isFinalStatus ? 'disabled' : '' }}>
                                                <option value="Pending"
                                                    {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Chờ xử lý
                                                </option>
                                                <option value="Confirmed"
                                                    {{ $order->order_status == 'Confirmed' ? 'selected' : '' }}>Đã xác nhận
                                                </option>
                                                <option value="Shipped"
                                                    {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Đã giao
                                                </option>
                                                <option value="Delivered"
                                                    {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Giao hàng
                                                    thành công</option>
                                                <option value="Cancelled"
                                                    {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Đã hủy
                                                </option>
                                            </select>

                                            {{-- Nếu bị disabled, vẫn gửi dữ liệu --}}
                                            @if ($isFinalStatus)
                                                <input type="hidden" name="order_status"
                                                    value="{{ $order->order_status }}">
                                            @endif
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="bi bi-emoji-frown fs-1"></i>
                                            <p class="mt-2">Không có đơn hàng nào.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
