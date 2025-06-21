@extends('user.master_latout.main')

@section('title', 'Sản phẩm')

@section('main')
    <!-- Breadcrumb -->
    <header class="product-detail-header">
        <div class="container">
            <nav class="product-detail-breadcrumb">
                <a href="{{ route('home') }}" class="product-detail-breadcrumb__item">Trang chủ</a>
                <span class="product-detail-breadcrumb__separator">></span>
                <span class="product-detail-breadcrumb__current">Sản Phẩm</span>
            </nav>
        </div>
    </header>

    <div class="prd-container">
        <div class="prd-main">
            <form action="{{ route('product') }}" method="GET" id="filterForm">
                <div class="prd-sidebar">
                    <!-- PRICE FILTER -->
                    <div class="prd-filter-section">
                        <div class="prd-filter-header">CHỌN MỨC GIÁ</div>
                        <div class="prd-filter-content">
                            @php
                                $selectedPrices = request('price_filters', []);
                            @endphp
                            @foreach ([
            'price1' => 'Dưới 1 triệu',
            'price2' => '1 - 2 triệu',
            'price3' => '2 - 3 triệu',
            'price4' => 'Trên 3 triệu',
        ] as $value => $label)
                                <div class="prd-filter-option {{ in_array($value, $selectedPrices) ? 'checked' : '' }}">
                                    <input type="checkbox" name="price_filters[]" value="{{ $value }}"
                                        id="{{ $value }}" {{ in_array($value, $selectedPrices) ? 'checked' : '' }}>
                                    <label for="{{ $value }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- BRAND FILTER -->
                    <div class="prd-filter-section">
                        <div class="prd-filter-header">THƯƠNG HIỆU</div>
                        <div class="prd-filter-content">
                            @foreach ($brands as $brand)
                                @php
                                    $selectedBrands = request('brands', []);
                                    $isChecked = in_array($brand->brand_id, $selectedBrands);
                                @endphp
                                <div class="prd-filter-option {{ $isChecked ? 'checked' : '' }}">
                                    <input type="checkbox" id="brand_{{ $brand->brand_id }}" name="brands[]"
                                        value="{{ $brand->brand_id }}" {{ $isChecked ? 'checked' : '' }}>
                                    <label for="brand_{{ $brand->brand_id }}">{{ $brand->brand_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- CATEGORY FILTER -->
                    <div class="prd-filter-section">
                        <div class="prd-filter-header">DANH MỤC</div>
                        <div class="prd-filter-content">
                            @foreach ($categories as $category)
                                @php
                                    $selectedCats = request('categories', []);
                                    $isChecked = in_array($category->category_id, $selectedCats);
                                @endphp
                                <div class="prd-filter-option {{ $isChecked ? 'checked' : '' }}">
                                    <input type="checkbox" id="categories_{{ $category->category_id }}" name="categories[]"
                                        value="{{ $category->category_id }}" {{ $isChecked ? 'checked' : '' }}>
                                    <label
                                        for="categories_{{ $category->category_id }}">{{ $category->category_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>

            <script>
                document.querySelectorAll('#filterForm input[type=checkbox]').forEach(el => {
                    el.addEventListener('change', () => {
                        document.getElementById('filterForm').submit();
                    });
                });
            </script>


            <!-- Main Content -->
            <div class="prd-content">
                <!-- Brand Logos -->
                <div class="prd-brands">
                    @foreach ($brands as $brand)
                        <div class="prd-brand-logo">
                            <img src="{{ asset($brand->brand_logo_url) }}" alt="{{ $brand->brand_name }}">
                        </div>
                    @endforeach
                </div>

                <!-- Section Header -->
                <div class="prd-section-header">
                    <h2 class="prd-section-title">VỢT CẦU LÔNG YONEX</h2>
                    <div class="prd-sort-options">
                        <span>Sắp xếp:</span>
                        <form action="{{ route('product') }}" method="GET" id="filterForm">
                            <select class="prd-sort-select" name="sort_by" onchange="this.form.submit()">
                                <option value="" {{ request('sort_by') == '' ? 'selected' : '' }}>Mặc định</option>
                                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Giá
                                    tăng
                                    dần</option>
                                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Giá
                                    giảm
                                    dần</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="prd-grid">
                    @forelse ($products as $product)
                        <div class="prd-item">
                            @if ($product->product_extend && $product->product_extend->is_premium)
                                <div class="prd-premium-badge">Premium</div>
                            @endif
                            <a href="{{ route('product-detail', $product->product_id) }}">
                                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->product_name }}"
                                    class="prd-item-image">
                                <div class="prd-item-name">{{ $product->product_name }}</div>
                                <div class="prd-item-price">{{ number_format($product->base_price, 0, ',', '.') }} đ
                                </div>
                            </a>
                        </div>
                    @empty
                        <p>Không có sản phẩm nào phù hợp.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
