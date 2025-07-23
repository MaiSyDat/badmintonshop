@extends('user.master_latout.main')

@section('title', 'Chi tiết sản phẩm')

@section('main')
    <!-- Header -->
    <header class="product-detail-header">
        <div class="container">
            <nav class="product-detail-breadcrumb">
                <a href="{{ route('home') }}" class="product-detail-breadcrumb__item">Trang chủ</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <a href="#" class="product-detail-breadcrumb__item">{{ $product->category->category_name }}</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <a href="#" class="product-detail-breadcrumb__item">{{ $product->brand->brand_name }}</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <span class="product-detail-breadcrumb__current">{{ $product->product_name }}</span>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="product-detail-main">
        <div class="container">
            <div class="grid wide">
                <div class="row">
                    <!-- Product Section -->
                    <div class="col c-12 m-12 l-9">
                        <div class="product-detail-section">
                            <div class="row">
                                <!-- Product Images -->
                                <div class="col c-12 m-6 l-5">
                                    <div class="product-detail-gallery">
                                        <div class="product-detail-gallery__main">
                                            <img src="{{ asset($product->main_image_url) }}"
                                                alt="{{ $product->product_name }}" id="productDetailMainImage">
                                        </div>
                                        <div class="product-detail-gallery__thumbnails">

                                            <img src="{{ asset($product->main_image_url) }}"
                                                alt="{{ $product->product_name }}" id="productDetailMainImage"
                                                class="product-detail-gallery__thumbnail"
                                                onclick="ProductDetail.changeImage(this)">

                                            @if ($product->images && $product->images->count())
                                                @foreach ($product->images as $image)
                                                    <img src="{{ asset($image->path) }}" alt="Ảnh phụ"
                                                        class="product-detail-gallery__thumbnail"
                                                        onclick="ProductDetail.changeImage(this)">
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="col c-12 m-6 l-7">
                                    <div class="product-detail-info">
                                        <h1 class="product-detail-info__title">{{ $product->product_name }}</h1>

                                        <div class="product-detail-info__meta">
                                            <span class="product-detail-info__brand">
                                                Thương hiệu:
                                                <strong>{{ $product->brand->brand_name ?? 'Không rõ' }}</strong>
                                            </span>

                                            <span class="product-detail-info__sku">
                                                Mã sản phẩm:
                                                <strong>SKU-{{ $product->variants->first()->sku ?? 'Không có' }}</strong>
                                            </span>

                                            <span class="product-detail-info__quantity ms-3">
                                                Tồn kho:
                                                <strong>{{ $product->variants->first()->quantity ?? 0 }}</strong>
                                            </span>
                                        </div>

                                        @php
                                            $variant = $product->variants->first();
                                            $discount = $variant->discount ?? 0;
                                            $basePrice = $product->base_price;

                                            $finalPrice = max(0, $basePrice - $discount); // không để âm
                                            $discountPercent =
                                                $basePrice > 0 ? round(($discount / $basePrice) * 100) : 0;
                                        @endphp

                                        <div class="product-detail-price">
                                            <span class="product-detail-price__current">
                                                {{ number_format($finalPrice, 0, ',', '.') }}₫
                                            </span>

                                            @if ($discount > 0)
                                                <span class="product-detail-price__original">
                                                    {{ number_format($basePrice, 0, ',', '.') }}₫
                                                </span>
                                                <span class="product-detail-price__discount">
                                                    -{{ $discountPercent }}%
                                                </span>
                                            @endif
                                        </div>

                                        <div class="product-detail-rating">
                                            <div class="product-detail-rating__stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span
                                                        class="product-detail-rating__star {{ $i <= round($averageRating) ? 'product-detail-rating__star--filled' : '' }}">★</span>
                                                @endfor
                                            </div>
                                            <span class="product-detail-rating__text">
                                                {{ $averageRating }}/5 ({{ $ratingCount }} đánh giá)
                                            </span>
                                        </div>

                                        <div class="product-detail-actions">
                                            <form action="{{ route('add.cart', $product->product_id) }}" method="POST">
                                                @csrf
                                                <div class="quantity-wrapper">
                                                    <button type="button" class="quantity-btn">-</button>
                                                    <input type="number" id="quantityInput" name="quantity" value="1"
                                                        min="1" class="quantity-input">
                                                    <button type="button" class="quantity-btn">+</button>
                                                </div>
                                                <div class="d-flex gap-2 mb-3">
                                                    <button type="submit" name="action" value="add"
                                                        class="product-detail-btn product-detail-btn--primary product-detail-btn--large">Thêm
                                                        vào giỏ</button>
                                                    <button type="submit" name="action" value="buy_now"
                                                        class="product-detail-btn product-detail-btn--secondary product-detail-btn--large">Mua
                                                        ngay</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="product-detail-promotion">
                                            <h4 class="product-detail-promotion__title">KHUYẾN MÃI - ƯU ĐÃI</h4>
                                            <ul class="product-detail-promotion__list">
                                                <li>🎁 Tặng bao vợt cao cấp khi mua từ 2 cây</li>
                                                <li>🚚 Miễn phí vận chuyển toàn quốc cho đơn hàng từ 500k</li>
                                                <li>💰 Giảm thêm 5% khi thanh toán online</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Specifications -->
                            <div class="product-detail-specs mb-20">
                                <h3 class="product-detail-specs__title">Thông số kỹ thuật</h3>
                                <div class="product-detail-specs__table">
                                    @if ($product->variants->isNotEmpty())
                                        @php $v = $product->variants->first(); @endphp
                                        <table class="table">
                                            <tr>
                                                <td>Màu sắc</td>
                                                <td>{{ $v->color }}</td>
                                            </tr>
                                            <tr>
                                                <td>Trọng lượng</td>
                                                <td>{{ $v->weight_WU }}</td>
                                            </tr>
                                            <tr>
                                                <td>Chiều dài</td>
                                                <td>{{ $v->length }}</td>
                                            </tr>
                                            <tr>
                                                <td>Chu vi cán vợt</td>
                                                <td>{{ $v->grip_size_G }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sức căng</td>
                                                <td>{{ $v->lbs }}</td>
                                            </tr>
                                            <tr>
                                                <td>Chất liệu</td>
                                                <td>{{ $v->material }}</td>
                                            </tr>
                                            <tr>
                                                <td>Độ cân bằng</td>
                                                <td>{{ $v->balance }}</td>
                                            </tr>
                                            <tr>
                                                <td>Độ cứng</td>
                                                <td>{{ $v->stiffness }}</td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>

                            <!-- Product description -->
                            <div class="product-detail-specs mb-20">
                                <h3 class="product-detail-specs__title">Mô tả sản phẩm</h3>
                                <div class="product-detail-specs__content">
                                    {!! nl2br(e($product->long_description)) !!}
                                </div>
                            </div>


                            <!-- Reviews Section -->
                            <div class="product-detail-reviews">
                                <h3 class="product-detail-specs__title">ĐÁNH GIÁ & NHẬN XÉT VỀ SẢN PHẨM</h3>

                                <div class="product-detail-reviews__overview">
                                    <div class="product-detail-reviews__summary">
                                        <div class="product-detail-reviews__overall">
                                            <span class="product-detail-reviews__number">{{ $averageRating }}/5</span>
                                            <div class="product-detail-reviews__stars-large">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span
                                                        class="product-detail-rating__star {{ $i <= round($averageRating) ? 'product-detail-rating__star--filled' : '' }}">★</span>
                                                @endfor
                                            </div>
                                            <p>Dựa trên {{ $ratingCount }} nhận xét</p>
                                        </div>

                                        <div class="product-detail-reviews__breakdown">
                                            @for ($i = 5; $i >= 1; $i--)
                                                @php
                                                    $percent =
                                                        $ratingCount > 0
                                                            ? ($ratingDistribution[$i] / $ratingCount) * 100
                                                            : 0;
                                                @endphp
                                                <div class="product-detail-reviews__bar">
                                                    <span>{{ $i }}★</span>
                                                    <div class="product-detail-reviews__bar-track">
                                                        <div class="product-detail-reviews__bar-fill"
                                                            style="width: {{ $percent }}%"></div>
                                                    </div>
                                                    <span>{{ $ratingDistribution[$i] }} đánh giá</span>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                {{-- ========== FORM ĐÁNH GIÁ ========== --}}
                                <div class="product-detail-reviews__form">
                                    <h4>Bạn đánh giá sao về sản phẩm này?</h4>

                                    @auth
                                        @if ($hasPurchased && !$hasReviewed)
                                            <form action="{{ route('reviews.store', $product->product_id) }}" method="POST">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <label for="rating">Đánh giá:</label>
                                                    <div class="product-detail-rating__stars">
                                                        @for ($i = 5; $i >= 1; $i--)
                                                            <input type="radio" name="rating"
                                                                id="star{{ $i }}" value="{{ $i }}"
                                                                required hidden>
                                                            <label for="star{{ $i }}"
                                                                class="product-detail-rating__star">★</label>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="comment">Bình luận:</label>
                                                    <textarea name="comment" class="form-control" rows="3" required></textarea>
                                                </div>

                                                <button class="product-detail-btn product-detail-btn--primary">
                                                    Gửi đánh giá
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để gửi đánh giá.</p>
                                    @endauth
                                </div>

                                {{-- ========== DANH SÁCH ĐÁNH GIÁ ========== --}}
                                <div class="product-detail-reviews__list">
                                    @foreach ($reviews as $review)
                                        <div class="product-detail-reviews__item">
                                            <div class="product-detail-reviews__item-info">
                                                <strong>{{ $review->user->full_name }}</strong>
                                                <div class="product-detail-rating__stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span
                                                            class="product-detail-rating__star {{ $i <= $review->rating ? 'product-detail-rating__star--filled' : '' }}">★</span>
                                                    @endfor
                                                </div>
                                                <span
                                                    class="product-detail-reviews__item-date">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="product-detail-reviews__item-text">{{ $review->comment }}</p>

                                            {{-- Nếu có phản hồi từ admin --}}
                                            @if ($review->reply)
                                                <div class="product-detail-reviews__reply">
                                                    <strong>Phản hồi:</strong>
                                                    <p>{{ $review->reply }}</p>
                                                </div>
                                            @endif

                                            {{-- Form phản hồi của admin --}}
                                            @auth
                                                @if (auth()->user()->isAdmin())
                                                    <form action="{{ route('reviews.reply', $review->review_id) }}"
                                                        method="POST" class="mt-2">
                                                        @csrf
                                                        <textarea name="reply" rows="2" class="form-control mb-1" placeholder="Phản hồi...">{{ $review->reply }}</textarea>
                                                        <button class="btn btn-sm btn-primary">Gửi phản hồi</button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col c-12 m-12 l-3">
                        <div class="product-detail-sidebar">
                            <h3 class="product-detail-sidebar__title">DANH MỤC SẢN PHẨM</h3>
                            <ul class="product-detail-sidebar__categories">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="#" class="product-detail-sidebar__category">
                                            {{ $category->category_name }}
                                            <span>+</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
