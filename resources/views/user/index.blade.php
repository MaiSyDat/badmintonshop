@extends('user.master_latout.main')
@section('main')
    @include('user.component.slider')
    <!-- Main Services Banner -->
    <div class="services-banner">
        <div class="services-container">
            <!-- Service 1: Nationwide Shipping -->
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M3 4h13l3 3v6h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3H9c0 1.66-1.34 3-3 3s-3-1.34-3-3H1V4h2zm11 8V9l-1-1H3v4h1c0-1.66 1.34-3 3-3s3 1.34 3 3h4z" />
                        <circle cx="6" cy="16" r="2" />
                        <circle cx="16" cy="16" r="2" />
                    </svg>
                </div>
                <div class="service-content">
                    <div class="service-title">Vận chuyển <span class="highlight">TOÀN QUỐC</span></div>
                    <div class="service-description">Thanh toán khi nhận hàng</div>
                </div>
            </div>

            <!-- Service 2: Quality Guarantee -->
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z" />
                    </svg>
                </div>
                <div class="service-content">
                    <div class="service-title">Bảo đảm <span class="highlight">CHẤT LƯỢNG</span></div>
                    <div class="service-description">Sản phẩm bảo đảm chất lượng</div>
                </div>
            </div>

            <!-- Service 3: Convenient Payment -->
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                    </svg>
                </div>
                <div class="service-content">
                    <div class="service-title">Tiện hành <span class="highlight">THANH TOÁN</span></div>
                    <div class="service-description">Với nhiều <span class="highlight">PHƯƠNG THỨC</span></div>
                </div>
            </div>

            <!-- Service 4: Product Exchange -->
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
                    </svg>
                </div>
                <div class="service-content">
                    <div class="service-title">Đổi sản phẩm <span class="highlight">MỚI</span></div>
                    <div class="service-description">nếu sản phẩm lỗi</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h2 class="section-title">Sản phẩm</h2>
        </div>

        @if (Auth::check())
            <p>Đã đăng nhập: {{ Auth::user()->email }}</p>
        @else
            <p>Chưa đăng nhập</p>
        @endif


        <div class="product-grid row">
            <!-- Product 1 -->
            <div class="col l-4 m-4 c-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/nhung-cay-vot-cau-long-nhe-nhat-1.webp"
                            alt="Yonex Arcsaber 11">
                        <div class="new-badge">New</div>
                        <button class="wishlist-btn">
                            <svg viewBox="0 0 24 24" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
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
                        <div class="product-name">Yonex Arcsaber 11 Professional / Black</div>
                        <div class="product-price">109.00€</div>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col l-4 m-4 c-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/nhung-cay-vot-cau-long-nhe-nhat-1.webp"
                            alt="Yonex Arcsaber 11">
                        <div class="new-badge">New</div>
                        <button class="wishlist-btn">
                            <svg viewBox="0 0 24 24" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
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
                        <div class="product-name">Yonex Arcsaber 11 Professional / Black</div>
                        <div class="product-price">109.00€</div>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col l-4 m-4 c-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/nhung-cay-vot-cau-long-nhe-nhat-1.webp"
                            alt="Yonex Arcsaber 11">
                        <div class="new-badge">New</div>
                        <button class="wishlist-btn">
                            <svg viewBox="0 0 24 24" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
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
                        <div class="product-name">Yonex Arcsaber 11 Professional / Black</div>
                        <div class="product-price">109.00€</div>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col l-4 m-4 c-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/nhung-cay-vot-cau-long-nhe-nhat-1.webp"
                            alt="Yonex Arcsaber 11">
                        <div class="new-badge">New</div>
                        <button class="wishlist-btn">
                            <svg viewBox="0 0 24 24" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
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
                        <div class="product-name">Yonex Arcsaber 11 Professional / Black</div>
                        <div class="product-price">109.00€</div>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="col l-4 m-4 c-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/nhung-cay-vot-cau-long-nhe-nhat-1.webp"
                            alt="Yonex Arcsaber 11">
                        <div class="new-badge">New</div>
                        <button class="wishlist-btn">
                            <svg viewBox="0 0 24 24" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
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
                        <div class="product-name">Yonex Arcsaber 11 Professional / Black</div>
                        <div class="product-price">109.00€</div>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="col l-4 m-4 c-6">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/nhung-cay-vot-cau-long-nhe-nhat-1.webp"
                            alt="Yonex Arcsaber 11">
                        <div class="new-badge">New</div>
                        <button class="wishlist-btn">
                            <svg viewBox="0 0 24 24" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
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
                        <div class="product-name">Yonex Arcsaber 11 Professional / Black</div>
                        <div class="product-price">109.00€</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="load-more">
            <button class="load-more-btn">View More ▼</button>
        </div>
    </div>

    {{-- Sectionn 2 --}}
    <div class="container">

        <!-- Header -->
        <div class="header-section">
            <h2 class="section-title">Hãng Vợt</h2>
        </div>

        <!-- Slider Section -->
        <div class="slider-container">
            <div class="slider-wrapper" id="sliderWrapper">
                <!-- Slide 1: Yonex -->
                <div class="slide yonex">
                    <div class="decoration"></div>
                    <div class="decoration"></div>
                    <div class="slide-content">
                        <h2 class="brand-name">YONEX</h2>
                        <p class="brand-description">Thương hiệu hàng đầu từ Nhật Bản với công nghệ tiên tiến</p>
                        <button class="brand-btn">Khám phá ngay</button>
                    </div>
                    <div class="slide-image">
                        <img src="/placeholder.svg?height=200&width=250" alt="Yonex Racket">
                    </div>
                </div>

                <!-- Slide 2: Victor -->
                <div class="slide victor">
                    <div class="decoration"></div>
                    <div class="decoration"></div>
                    <div class="slide-content">
                        <h2 class="brand-name">VICTOR</h2>
                        <p class="brand-description">Thương hiệu Đài Loan nổi tiếng với chất lượng vượt trội</p>
                        <button class="brand-btn">Xem sản phẩm</button>
                    </div>
                    <div class="slide-image">
                        <img src="/placeholder.svg?height=200&width=250" alt="Victor Racket">
                    </div>
                </div>

                <!-- Slide 3: Li-Ning -->
                <div class="slide lining">
                    <div class="decoration"></div>
                    <div class="decoration"></div>
                    <div class="slide-content">
                        <h2 class="brand-name">LI-NING</h2>
                        <p class="brand-description">Thương hiệu Trung Quốc với thiết kế hiện đại và bền bỉ</p>
                        <button class="brand-btn">Tìm hiểu thêm</button>
                    </div>
                    <div class="slide-image">
                        <img src="/placeholder.svg?height=200&width=250" alt="Li-Ning Racket">
                    </div>
                </div>

                <!-- Slide 4: Mizuno -->
                <div class="slide mizuno">
                    <div class="decoration"></div>
                    <div class="decoration"></div>
                    <div class="slide-content">
                        <h2 class="brand-name">MIZUNO</h2>
                        <p class="brand-description">Thương hiệu Nhật Bản với truyền thống lâu đời</p>
                        <button class="brand-btn">Mua ngay</button>
                    </div>
                    <div class="slide-image">
                        <img src="/placeholder.svg?height=200&width=250" alt="Mizuno Racket">
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button class="slider-nav prev">‹</button>
            <button class="slider-nav next">›</button>
        </div>

        <!-- Slider Dots -->
        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
        </div>

        <!-- Categories Section -->
        <div class="categories-section">
            <div class="header-section">
                <h2 class="section-title">Danh Mục Hãng Vợt</h2>
            </div>

            <div class="categories-grid">
                <!-- Yonex Category -->
                <div class="category-card">
                    <div class="category-image">
                        <img src="/placeholder.svg?height=120&width=120" alt="Yonex Logo">
                        <div class="category-badge">Hot</div>
                    </div>
                    <div class="category-info">
                        <h3 class="category-name">YONEX</h3>
                        <p class="category-description">Thương hiệu số 1 thế giới về vợt cầu lông với công nghệ Isometric
                            và Nanometric</p>
                    </div>
                </div>

                <!-- Victor Category -->
                <div class="category-card">
                    <div class="category-image">
                        <img src="/placeholder.svg?height=120&width=120" alt="Victor Logo">
                        <div class="category-badge">New</div>
                    </div>
                    <div class="category-info">
                        <h3 class="category-name">VICTOR</h3>
                        <p class="category-description">Thương hiệu Đài Loan với công nghệ PYROFIL và thiết kế aerodynamic
                        </p>
                    </div>
                </div>

                <!-- Li-Ning Category -->
                <div class="category-card">
                    <div class="category-image">
                        <img src="/placeholder.svg?height=120&width=120" alt="Li-Ning Logo">
                        <div class="category-badge">Sale</div>
                    </div>
                    <div class="category-info">
                        <h3 class="category-name">LI-NING</h3>
                        <p class="category-description">Thương hiệu Trung Quốc với công nghệ TB NANO và Dynamic-Optimum
                            Frame</p>
                    </div>
                </div>

                <!-- Mizuno Category -->
                <div class="category-card">
                    <div class="category-image">
                        <img src="/placeholder.svg?height=120&width=120" alt="Mizuno Logo">
                        <div class="category-badge">Pro</div>
                    </div>
                    <div class="category-info">
                        <h3 class="category-name">MIZUNO</h3>
                        <p class="category-description">Thương hiệu Nhật Bản với công nghệ Solid Feel Core và Fast Energy
                            Transfer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
