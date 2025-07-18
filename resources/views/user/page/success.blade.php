@extends('user.master_latout.main')

@section('title', 'Thanh toán thành công')

@section('main')
    <div class="success-container">
        <h4 class="success-heading">
            <i class="bi bi-file-earmark-text"></i> Đặt hàng thành công!
        </h4>

        <!-- Thông tin đơn hàng -->
        <div class="success-order-info">
            <h5 class="success-subheading">
                <i class="bi bi-receipt-cutoff"></i> Thông tin đơn hàng
            </h5>
            <div class="success-row">
                <div class="success-col-8">
                    <p><i class="bi bi-upc-scan"></i> <strong>Mã đơn hàng:</strong> #{{ $order->order_id }}</p>
                    <p><i class="bi bi-calendar3"></i> <strong>Ngày đặt:</strong>
                        {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><i class="bi bi-chat-text"></i> <strong>Ghi chú:</strong> {{ $order->notes ?? 'Không có' }}</p>
                </div>
                <div class="success-col-4">
                    <p><i class="bi bi-bag-check"></i> <strong>Số lượng:</strong> {{ $order->orderItems->sum('quantity') }}
                    </p>
                    <p><i class="bi bi-cash-stack"></i> <strong>Tổng tiền:</strong>
                        <span class="success-price">
                            {{ number_format($order->total_amount, 0, ',', '.') }} ₫
                        </span>
                    </p>
                    <p>
                        <i class="bi bi-credit-card"></i> <strong>Thanh toán:</strong>
                        <span
                            class="success-badge {{ $order->payment_status == 'Paid' ? 'success-paid' : 'success-unpaid' }}">
                            {{ $order->payment_status == 'Paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                    </p>
                    <p>
                        <i class="bi bi-truck"></i> <strong>Vận chuyển:</strong>
                        <span
                            class="success-badge {{ $order->order_status == 'Shipping' ? 'success-shipping' : 'success-pending' }}">
                            {{ $order->order_status == 'Shipping' ? 'Đang giao' : 'Chờ xử lý' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="success-product-details">
            <h5 class="success-subheading">
                <i class="bi bi-box-seam"></i> Sản phẩm đã đặt
            </h5>
            <div class="success-table-wrapper">
                <table class="success-table">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalBeforeDiscount = collect($order->orderItems)->sum(
                                fn($item) => $item->price_per_item * $item->quantity,
                            );
                            $discountAmount = $totalBeforeDiscount - $order->total_amount;
                        @endphp

                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->product_name ?? 'Sản phẩm đã xoá' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price_per_item, 0, ',', '.') }} ₫</td>
                                <td>
                                    @if ($loop->first)
                                        {{ number_format($discountAmount, 0, ',', '.') }} ₫ {{-- Hiển thị một lần --}}
                                    @endif
                                </td>
                                <td class="success-price">
                                    {{ number_format($item->price_per_item * $item->quantity, 0, ',', '.') }} ₫
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="success-total-label">Tổng cộng:</td>
                            <td class="success-price">
                                {{ number_format($order->total_amount, 0, ',', '.') }} ₫
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="success-btn-wrapper">
            <a href="{{ route('home') }}" class="success-back-btn">
                <i class="bi bi-arrow-left-circle"></i> Tiếp tục mua hàng
            </a>
        </div>
    </div>
@endsection
