@extends('user.master_latout.main')

@section('title', 'Trang chủ')

@section('main')
    @include('user.component.slider')

    <!-- ===== START SECTION: SERVICES BANNER ===== -->
    <section class="services-banner">
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
    </section>
    <!-- ===== END SECTION: SERVICES BANNER ===== -->

    <!-- ===== START SECTION: CATEGORIES ===== -->
    <section class="categories-section">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <h2 class="section-title">Danh Mục Sản Phẩm</h2>
                    <p class="section-subtitle">
                        Tìm kiếm vợt cầu lông phù hợp với phong cách chơi của bạn
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($topCategories as $category)
                    <div class="col l-4 m-6 c-12">
                        <div class="category-card">
                            <div class="category-icon">
                                <i class="fas fa-bolt"></i> {{-- Bạn có thể tùy biến icon theo từng category nếu muốn --}}
                            </div>
                            <h3 class="category-title">{{ $category->category_name }}</h3>
                            <p class="category-description">
                                {{ $category->description ?? 'Chưa có mô tả cho danh mục này.' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: CATEGORIES ===== -->

    <!-- ===== START SECTION: FEATURED PRODUCTS ===== -->
    <section class="featured-products-section" id="products">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
                    <p class="section-subtitle">
                        Những mẫu vợt cầu lông được yêu thích nhất tại BadmintonShop
                    </p>
                </div>
            </div>
            <div class="product-grid row">
                @foreach ($featuredProducts as $product)
                    <div class="mb-20 col l-4 m-4 c-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->product_name }}"
                                    class="product-image">
                                <div class="new-badge">New</div>
                                <div class="discount-badge">-10%</div> <!-- Thêm badge giảm giá -->
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
                                <div class="product-name">{{ $product->product_name }}</div>
                                <div class="product-price">{{ number_format($product->base_price, 0, ',', '.') }}₫</div>
                                <a href="{{ route('product-detail', $product->product_id) }}"
                                    class="buy-now-btn btn-primary">Mua
                                    ngay</a> <!-- Thêm nút mua ngay -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: FEATURED PRODUCTS ===== -->

    <!-- ===== START SECTION: PRODUCT GRID ===== -->
    <section class="product-grid-section">
        <div class="container">
            <div class="title">
                <h2 class="section-title">Sản phẩm</h2>
                <p class="section-subtitle">
                    Những mẫu vợt cầu lông mới nhất tại BadmintonShop
                </p>
            </div>

            <div class="product-grid row">
                @foreach ($latestProducts as $product)
                    <div class="mb-20 col l-4 m-4 c-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->product_name }}"
                                    class="product-image">
                                <div class="new-badge">New</div>
                                <div class="discount-badge">-10%</div> <!-- Thêm badge giảm giá -->
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
                                <div class="product-name">{{ $product->product_name }}</div>
                                <div class="product-price">{{ number_format($product->base_price, 0, ',', '.') }}₫</div>
                                <a href="{{ route('product-detail', $product->product_id) }}"
                                    class="buy-now-btn btn-primary">Mua
                                    ngay</a> <!-- Thêm nút mua ngay -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="load-more">
                <button class="load-more-btn">View More ▼</button>
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: PRODUCT GRID ===== -->

    <!-- ===== START SECTION: WHY CHOOSE US ===== -->
    <section class="why-choose-us-section">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <h2 class="section-title">Tại Sao Chọn BadmintonShop?</h2>
                    <p class="section-subtitle">
                        Chúng tôi cam kết mang đến trải nghiệm mua sắm tốt nhất cho khách hàng
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col l-3 m-6 c-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3 class="feature-title">100% Chính Hãng</h3>
                        <p class="feature-description">
                            Tất cả sản phẩm đều có tem chống hàng giả và được bảo hành chính
                            hãng từ nhà sản xuất.
                        </p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="feature-title">Giao Hàng Nhanh</h3>
                        <p class="feature-description">
                            Giao hàng toàn quốc trong 1-3 ngày, miễn phí ship cho đơn hàng trên
                            500k.
                        </p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3 class="feature-title">Dịch Vụ Căng Cước</h3>
                        <p class="feature-description">
                            Căng cước chuyên nghiệp với máy điện tử, đảm bảo độ căng chính xác
                            theo yêu cầu.
                        </p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="feature-title">Hỗ Trợ 24/7</h3>
                        <p class="feature-description">
                            Đội ngũ tư vấn chuyên nghiệp sẵn sàng hỗ trợ bạn lựa chọn sản phẩm
                            phù hợp nhất.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: WHY CHOOSE US ===== -->

    <!-- ===== START SECTION: TESTIMONIALS ===== -->
    <section class="testimonials-section">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <h2 class="section-title">Khách Hàng Nói Gì Về Chúng Tôi</h2>
                    <p class="section-subtitle">
                        Hàng nghìn khách hàng đã tin tưởng và hài lòng với dịch vụ của chúng
                        tôi
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col l-4 m-6 c-12">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Vợt chính hãng, giá cả hợp lý. Dịch vụ căng cước rất chuyên nghiệp.
                            Tôi đã mua 3 cây vợt ở đây và đều rất hài lòng."
                        </p>
                        <div class="testimonial-author">Nguyễn Văn An</div>
                        <div class="testimonial-role">Vận động viên cầu lông</div>
                    </div>
                </div>
                <div class="col l-4 m-6 c-12">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Giao hàng nhanh, đóng gói cẩn thận. Nhân viên tư vấn nhiệt tình,
                            giúp tôi chọn được cây vợt phù hợp với trình độ."
                        </p>
                        <div class="testimonial-author">Trần Thị Bình</div>
                        <div class="testimonial-role">Người chơi nghiệp dư</div>
                    </div>
                </div>
                <div class="col l-4 m-6 c-12">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Shop uy tín, sản phẩm chất lượng. Đã giới thiệu cho nhiều bạn bè và
                            ai cũng hài lòng. Sẽ tiếp tục ủng hộ shop!"
                        </p>
                        <div class="testimonial-author">Lê Minh Cường</div>
                        <div class="testimonial-role">HLV cầu lông</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: TESTIMONIALS ===== -->

    <!-- ===== START SECTION: NEWSLETTER ===== -->
    <section class="newsletter-section">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <h2 class="section-title">Đăng Ký Nhận Tin</h2>
                    <p class="section-subtitle">
                        Nhận thông tin về sản phẩm mới và các chương trình khuyến mãi hấp dẫn
                    </p>
                    <form class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Nhập email của bạn" required />
                        <button type="submit" class="btn-primary">Đăng Ký</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: NEWSLETTER ===== -->

    <!-- ===== START SECTION: BRAND SLIDER ===== -->
    <section class="brand-slider-section">
        <div class="container">
            <!-- Header -->
            <div class="header-section">
                <h2 class="section-title">Hãng Vợt</h2>
            </div>

            <!-- Slider Section -->
            <div class="slider-container">
                <div class="slider-wrapper" id="sliderWrapper">
                    <!-- Slide 1: Yonex -->
                    @foreach ($brands as $brand)
                        <div class="slide {{ strtolower($brand->brand_name) }}">
                            <div class="decoration"></div>
                            <div class="decoration"></div>
                            <div class="slide-content">
                                <h2 class="brand-name">{{ $brand->brand_name }}</h2>
                                <p class="brand-description">Nơi hội tụ những cây vợt đỉnh cao – nâng tầm phong độ, chinh
                                    phục mọi sân chơi!</p>
                                <button class="brand-btn">Khám phá ngay</button>
                            </div>
                            <div class="slide-image">
                                <img src="{{ asset($brand->brand_logo_url) }}" alt="{{ $brand->brand_name }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <button class="slider-nav prev">‹</button>
                <button class="slider-nav next">›</button>
            </div>

            <!-- Slider Dots -->
            <div class="slider-dots">
                <span class="dot active" onclick="currentHomeSlide(0)"></span>
                <span class="dot" onclick="currentHomeSlide(1)"></span>
                <span class="dot" onclick="currentHomeSlide(2)"></span>
                <span class="dot" onclick="currentHomeSlide(3)"></span>
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: BRAND SLIDER ===== -->

    <!-- ===== START SECTION: SEO CONTENT ===== -->
    <section class="seo-content-section">
        <div class="grid wide">
            <div class="row">
                <div class="col l-8 m-12 c-12">
                    <h2 style="color: var(--title-color); margin-bottom: 20px">
                        Vợt Cầu Lông Chính Hãng - Lựa Chọn Hàng Đầu Của Người Chơi Chuyên
                        Nghiệp
                    </h2>
                    <p style="color: var(--text-color); line-height: 1.6; margin-bottom: 16px;">
                        <strong>BadmintonShop</strong> là địa chỉ tin cậy chuyên cung cấp
                        <strong>vợt cầu lông chính hãng</strong>
                        từ các thương hiệu hàng đầu thế giới như Yonex, Victor, Mizuno,
                        Li-Ning. Với hơn 5 năm kinh nghiệm trong lĩnh vực thể thao cầu lông,
                        chúng tôi hiểu rõ nhu cầu của từng khách hàng từ người mới bắt đầu đến
                        vận động viên chuyên nghiệp.
                    </p>
                    <p style="color: var(--text-color); line-height: 1.6; margin-bottom: 16px;">
                        Tại BadmintonShop, bạn sẽ tìm thấy đầy đủ các loại vợt cầu lông phù
                        hợp với mọi phong cách chơi: vợt tấn công cho những ai ưa thích smash
                        mạnh mẽ, vợt phòng thủ linh hoạt cho lối chơi kiểm soát, và vợt cân
                        bằng đa năng cho người chơi toàn diện.
                    </p>
                </div>
                <div class="col l-4 m-12 c-12">
                    <div style="background: var(--light); padding: 24px; border-radius: 12px">
                        <h3 style="color: var(--title-color); margin-bottom: 16px">
                            Thông Tin Liên Hệ
                        </h3>
                        <p style="color: var(--text-color); margin-bottom: 8px">
                            <i class="fas fa-phone" style="color: var(--primary-one); margin-right: 8px"></i>
                            Hotline: 1900-xxxx
                        </p>
                        <p style="color: var(--text-color); margin-bottom: 8px">
                            <i class="fas fa-envelope" style="color: var(--primary-one); margin-right: 8px"></i>
                            Email: info@badmintonshop.vn
                        </p>
                        <p style="color: var(--text-color)">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary-one); margin-right: 8px"></i>
                            Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== END SECTION: SEO CONTENT ===== -->
@endsection
