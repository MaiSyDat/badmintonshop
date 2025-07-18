@extends('user.master_latout.main')

@section('title', 'Đơn hàng của tôi')

@php
    $statusLabels = [
        'Pending' => 'Chờ xử lý',
        'Confirmed' => 'Đã xác nhận',
        'Shipped' => 'Đang giao',
        'Delivered' => 'Giao hàng thành công',
        'Cancelled' => 'Đã hủy',
    ];

    $statusColors = [
        'Pending' => 'warning',
        'Confirmed' => 'info',
        'Shipped' => 'primary',
        'Delivered' => 'success',
        'Cancelled' => 'danger',
    ];
@endphp

@section('main')
    <div class="myorder-container">
        @forelse($orders as $order)
            <div class="myorder-store-section">
                <div class="myorder-store-header">
                    <span class="myorder-store-name">Mã đơn: {{ $order->order_id }}</span>
                    <button class="myorder-chat-btn">💬 Chat</button>
                    <div class="myorder-delivery-info">
                        <span class="badge bg-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                            {{ $statusLabels[$order->order_status] ?? $order->order_status }}
                        </span>
                    </div>
                </div>

                @foreach ($order->orderItems as $item)
                    <div class="myorder-product-item">
                        <div class="myorder-product-image">
                            <img src="{{ asset($item->product->main_image_url ?? 'images/default.png') }}"
                                alt="{{ $item->product->product_name ?? 'Sản phẩm' }}">
                        </div>
                        <div class="myorder-product-info">
                            <h3 class="myorder-product-title">{{ $item->product->product_name ?? '[Không rõ tên]' }}</h3>
                            <p class="myorder-product-variant">Phân loại hàng: {{ $item->product->variant ?? 'N/A' }}</p>
                            <p class="myorder-product-quantity">x{{ $item->quantity }}</p>
                        </div>
                        <div class="myorder-product-price">
                            <span class="myorder-price">
                                ₫{{ number_format($item->price_per_item * $item->quantity, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Đánh giá từng sản phẩm -->
                        <div class="myorder-action-buttons">
                            @if (in_array($order->order_status, ['Delivered', 'Shipped']))
                                <a href="{{ route('product-detail', $item->product->product_id) }}"
                                    class="myorder-btn myorder-btn-primary">
                                    Đánh Giá
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="myorder-store-footer">
                    <div class="myorder-store-info">
                        <p>Đánh giá sản phẩm trước
                            {{ \Carbon\Carbon::parse($order->order_date)->addDays(14)->format('d-m-Y') }}</p>
                        <p>Đánh giá ngay và nhận 200 Xu</p>
                    </div>
                    <div class="myorder-store-total">
                        <span>Thành tiền: </span>
                        <span class="myorder-total-price">₫{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="myorder-action-buttons">
                    <button class="myorder-btn myorder-btn-secondary">Liên Hệ Người Bán</button>

                    @if ($order->order_status === 'Pending')
                        <form action="{{ route('user.cancelOrder', ['id' => $order->order_id]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button type="submit" class="myorder-btn myorder-btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">
                                Hủy Đơn
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center mt-5">Bạn chưa có đơn hàng nào.</p>
        @endforelse
    </div>
@endsection
