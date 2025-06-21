@extends('user.master_latout.main')

@section('title', 'Thanh toán')

@section('main')
    <header class="product-detail-header">
        <div class="container">
            <nav class="product-detail-breadcrumb">
                <a href="{{ route('home') }}" class="product-detail-breadcrumb__item">Trang chủ</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <a href="{{ route('cart.index') }}" class="product-detail-breadcrumb__item">Giỏ hàng</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <span class="product-detail-breadcrumb__current">Thanh toán</span>
            </nav>
        </div>
    </header>

    <div class="ckout-container">
        <!-- Breadcrumb -->
        <div class="ckout-breadcrumb">
            <span class="ckout-breadcrumb-text">Bạn có mã ưu đãi?</span>
            <a href="#" class="ckout-breadcrumb-link">Ấn vào đây để nhập mã</a>
        </div>

        <div class="ckout-wrapper">
            <!-- Left Section - Payment Information -->
            <div class="ckout-payment-info">
                <h2 class="ckout-section-title">THÔNG TIN THANH TOÁN</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('checkout.process') }}" method="POST" class="ckout-payment-form">
                    @csrf
                    @php
                        $user = Auth::user();
                    @endphp

                    <div class="ckout-infor">
                        <div class="ckout-form-group">
                            <label for="fullname">Họ và Tên <span class="ckout-required">*</span></label>
                            <input type="text" id="fullname" name="fullname"
                                value="{{ old('fullname', $user->full_name) }}" placeholder="Họ tên người nhận hàng"
                                required>
                        </div>

                        <div class="ckout-form-group">
                            <label for="phone">Số điện thoại <span class="ckout-required">*</span></label>
                            <input type="tel" id="phone" name="phone"
                                value="{{ old('phone', $user->phone_number) }}" placeholder="Số điện thoại liên hệ"
                                required>
                        </div>

                        <div class="ckout-form-group">
                            <label for="address">Địa chỉ <span class="ckout-required">*</span></label>
                            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                                placeholder="Địa chỉ nhận hàng" required>
                        </div>

                        <div class="ckout-form-group">
                            <label class="ckout-sub-label">Ghi chú (tùy chọn)</label>
                            <textarea id="notes" name="notes" placeholder="Ghi chú chi tiết về địa chỉ giao hàng hoặc mức căng vợt (kg)...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Middle Section - Order Summary -->
                    <div class="ckout-order-summary">
                        <h2 class="ckout-section-title">ĐƠN HÀNG CỦA BẠN</h2>

                        <div class="ckout-order-details">
                            <div class="ckout-order-header">
                                <span class="ckout-product-label">SẢN PHẨM</span>
                                <span class="ckout-total-label">TẠM TÍNH</span>
                            </div>

                            <div class="ckout-order-items">
                                @forelse ($cart as $item)
                                    <div class="ckout-order-item">
                                        <span class="ckout-product-name">{{ $item->name }} × {{ $item->quantity }}</span>
                                        <span
                                            class="ckout-product-price">₫{{ number_format($item->price * $item->quantity) }}</span>
                                    </div>
                                @empty
                                    <div class="ckout-order-item">
                                        <span class="ckout-product-name">Không có sản phẩm trong giỏ hàng.</span>
                                    </div>
                                @endforelse
                            </div>

                            <div class="ckout-subtotal">
                                <span class="ckout-subtotal-label">Tạm tính</span>
                                <span class="ckout-subtotal-price">
                                    ₫{{ number_format(collect($cart)->sum(fn($item) => $item->price * $item->quantity)) }}
                                </span>
                            </div>

                            <div class="ckout-total">
                                <span class="ckout-total-label">TỔNG</span>
                                <span class="ckout-total-price">
                                    ₫{{ number_format(collect($cart)->sum(fn($item) => $item->price * $item->quantity)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section - Payment Methods & Checkout -->
                    <div class="ckout-payment-checkout">
                        <!-- Payment Methods -->
                        <div class="ckout-payment-methods">
                            <h3 class="ckout-payment-title">Phương thức thanh toán</h3>

                            <div class="ckout-payment-option">
                                <input type="radio" id="cod" name="payment_method" value="cod" checked>
                                <label for="cod" class="ckout-payment-label">
                                    <i class="fas fa-money-bill-wave ckout-payment-icon"></i>
                                    <span>Thanh toán khi nhận hàng (COD)</span>
                                </label>
                            </div>

                            <div class="ckout-payment-option">
                                <input type="radio" id="momo" name="payment_method" value="momo">
                                <label for="momo" class="ckout-payment-label">
                                    <div class="ckout-momo-icon">
                                        <img src="/placeholder.svg?height=24&width=24" alt="MoMo"
                                            class="ckout-momo-logo">
                                    </div>
                                    <span>Thanh toán bằng MoMo</span>
                                </label>
                            </div>
                        </div>

                        <div class="ckout-payment-info-text">
                            <p><strong>Trả tiền mặt và kiểm hàng khi nhận</strong></p>
                            <p>Kiểm tra sản phẩm trước khi nhận hàng và thanh toán với Shiper.</p>
                            <br>
                            <p>Vui lòng kiểm tra lại thông tin đặt hàng (sdt, địa chỉ...) một lần nữa trước khi đặt hàng!
                            </p>
                        </div>

                        <div class="ckout-confirmation">
                            <input type="checkbox" id="confirm" name="confirm" required>
                            <label for="confirm">
                                Tôi xác nhận những thông tin đặt hàng là chính xác
                                <span class="ckout-required">*</span>
                            </label>
                        </div>

                        <button type="submit" class="ckout-order-button">ĐẶT HÀNG</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
