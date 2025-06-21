@extends('user.master_latout.main')

@section('title', 'Giỏ hàng')

@section('main')
    @php
        $cart = session('cart', []);
    @endphp

    <header class="product-detail-header">
        <div class="container">
            <nav class="product-detail-breadcrumb">
                <a href="{{ route('home') }}" class="product-detail-breadcrumb__item">Trang chủ</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <span class="product-detail-breadcrumb__current">Giỏ hàng</span>
            </nav>
        </div>
    </header>

    <div class="ss_cart-container">
        <!-- Header -->
        <div class="ss_cart-header">
            <div class="ss_cart-header-item ss_cart-product-col">
                <input type="checkbox" id="select-all" class="ss_cart-checkbox">
                <label for="select-all">Sản Phẩm</label>
            </div>
            <div class="ss_cart-header-item">Đơn Giá</div>
            <div class="ss_cart-header-item">Số Lượng</div>
            <div class="ss_cart-header-item">Số Tiền</div>
            <div class="ss_cart-header-item">Thao Tác</div>
        </div>

        <!-- Store Section -->
        <div class="ss_cart-store-section">
            @foreach ($cart as $item)
                <div class="ss_cart-product-item">
                    <div class="ss_cart-product-info">
                        <input type="checkbox" class="ss_cart-product-checkbox ss_cart-checkbox">
                        <div class="ss_cart-product-image">
                            <img src="{{ asset($item->img) }}" alt="{{ $item->name }}" width="80" height="80">
                        </div>
                        <div class="ss_cart-product-details">
                            <h3>{{ $item->name }}</h3>
                            <div class="ss_cart-product-variant">
                                <span>Phân Loại Hàng:</span>
                                <select class="ss_cart-variant-select">
                                    <option>Không rõ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ss_cart-product-price">
                        <span class="ss_cart-original-price text-muted text-decoration-line-through">
                            ₫{{ number_format($item->price + 100000) }}
                        </span>
                        <span class="ss_cart-current-price">₫{{ number_format($item->price) }}</span>
                    </div>
                    <div class="ss_cart-quantity-control">
                        <button class="ss_cart-qty-btn ss_cart-minus">-</button>
                        <input type="number" value="{{ $item->quantity }}" class="ss_cart-qty-input" readonly>
                        <button class="ss_cart-qty-btn ss_cart-plus">+</button>
                    </div>
                    <div class="ss_cart-product-total">₫{{ number_format($item->price * $item->quantity) }}</div>
                    <div class="ss_cart-product-actions">
                        <form action="{{ route('delete.cart', ['product' => $item->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="ss_cart-delete-btn">Xóa</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Voucher Section -->
            <div class="ss_cart-voucher-section">
                <i class="fas fa-ticket-alt ss_cart-voucher-icon"></i>
                <span>Voucher giảm đến ₫5k</span>
                <button class="ss_cart-voucher-btn">Xem thêm voucher</button>
            </div>

            <!-- Shipping Section -->
            <div class="ss_cart-shipping-section">
                <i class="fas fa-truck ss_cart-shipping-icon"></i>
                <span>Giảm ₫700.000 phí vận chuyển đơn tối thiểu ₫0; Giảm ₫1.000.000 phí vận chuyển đơn tối thiểu
                    ₫500.000</span>
                <button class="ss_cart-shipping-btn">Tìm hiểu thêm</button>
            </div>
        </div>

        <!-- Shopee Voucher Section -->
        <div class="ss_cart-shopee-voucher">
            <i class="fas fa-gift ss_cart-voucher-gift-icon"></i>
            <span>Shopee Voucher</span>
            <button class="ss_cart-voucher-select-btn">Chọn hoặc nhập mã</button>
        </div>

        <!-- Bottom Actions -->
        <div class="ss_cart-bottom-actions">
            <div class="ss_cart-left-actions">
                <input type="checkbox" id="select-all-bottom" class="ss_cart-checkbox">
                <label for="select-all-bottom">Chọn Tất Cả ({{ count($cart) }})</label>
                <button class="ss_cart-delete-btn">Xóa</button>
                <button class="ss_cart-save-btn">Lưu vào mục Đã thích</button>
            </div>
            <div class="ss_cart-right-actions">
                <div class="ss_cart-total-section">
                    <span>Tổng cộng ({{ count($cart) }} sản phẩm): </span>
                    <span class="ss_cart-total-amount">
                        ₫{{ number_format(collect($cart)->sum(fn($item) => $item->price * $item->quantity)) }}
                    </span>
                </div>
                <a href="{{ route('checkout.index') }}" class="ss_cart-checkout-btn">Đặt hàng</a>
            </div>
        </div>
    </div>
@endsection
