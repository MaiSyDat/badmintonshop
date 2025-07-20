@extends('user.master_latout.main')

@section('title', 'Sản phẩm yêu thích')

@section('main')
    <header class="product-detail-header">
        <div class="container">
            <nav class="product-detail-breadcrumb">
                <a href="{{ route('home') }}" class="product-detail-breadcrumb__item">Trang chủ</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <span class="product-detail-breadcrumb__current">Sản phẩm yêu thích</span>
            </nav>
        </div>
    </header>

    <div class="container mt-20">
        <div class="ckout-breadcrumb">
            <span class="ckout-breadcrumb-link">Sản phẩm yêu thích</span>
        </div>

        @if ($wishlists->isEmpty())
            <p class="mt-20 mb-20">Bạn chưa có sản phẩm yêu thích nào.</p>
        @else
            <div class="product-grid row">
                @foreach ($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    @php
                        $variant = $product->variants->first();
                        $discount = $variant->discount ?? 0;
                        $basePrice = $product->base_price;

                        $finalPrice = max(0, $basePrice - $discount); // không để âm
                        $discountPercent = $basePrice > 0 ? round(($discount / $basePrice) * 100) : 0;
                    @endphp
                    <div class="mb-20 col l-4 m-4 c-6 wishlist-item" data-product-id="{{ $product->product_id }}">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->product_name }}"
                                    class="product-image">
                                <div class="new-badge">New</div>
                                <div class="discount-badge">-10%</div>
                                <button class="wishlist-btn active" data-product-id="{{ $product->product_id }}">
                                    <svg viewBox="0 0 24 24" stroke-width="2" style="fill: red; stroke: red;">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06
                                                                                a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12
                                                                                21.23l7.78-7.78 1.06-1.06a5.5 5.5 0
                                                                                0 0 0-7.78z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="product-info">
                                <div class="color-options">
                                    <div class="color-dot black"></div>
                                    <div class="color-dot white"></div>
                                    <div class="color-dot blue"></div>
                                </div>
                                <div class="product-name">{{ $product->product_name }}</div>
                                <div class="product-price"> {{ number_format($finalPrice, 0, ',', '.') }}₫</div>
                                <a href="{{ route('product-detail', $product->product_id) }}"
                                    class="buy-now-btn btn-primary">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Script xử lý xóa khỏi wishlist --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".wishlist-btn").forEach((button) => {
                button.addEventListener("click", function() {
                    const productId = this.dataset.productId;
                    const svg = this.querySelector("svg");
                    const productCard = this.closest(".wishlist-item");

                    fetch("/wishlist/remove", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                product_id: productId
                            }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                productCard.remove();
                            } else {
                                alert("Xóa khỏi yêu thích không thành công.");
                            }
                        })
                        .catch(() => {
                            alert("Vui lòng đăng nhập để thao tác.");
                        });
                });
            });
        });
    </script>
@endsection
