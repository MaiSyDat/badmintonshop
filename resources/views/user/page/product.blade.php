@extends('user.master_latout.main')

@section('title', 'Sản phẩm')

@section('main')
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
            <!-- FILTER SIDEBAR -->
            <div class="prd-sidebar" id="filterForm">
                <div class="prd-filter-section">
                    <div class="prd-filter-header">CHỌN MỨC GIÁ</div>
                    <div class="prd-filter-content">
                        @foreach ([
            'price1' => 'Dưới 1 triệu',
            'price2' => '1 - 2 triệu',
            'price3' => '2 - 3 triệu',
            'price4' => 'Trên 3 triệu',
        ] as $value => $label)
                            <div class="prd-filter-option">
                                <input type="checkbox" name="price_filters[]" value="{{ $value }}"
                                    id="{{ $value }}">
                                <label for="{{ $value }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="prd-filter-section">
                    <div class="prd-filter-header">THƯƠNG HIỆU</div>
                    <div class="prd-filter-content">
                        @foreach ($brands as $brand)
                            <div class="prd-filter-option">
                                <input type="checkbox" id="brand_{{ $brand->brand_id }}" name="brands[]"
                                    value="{{ $brand->brand_id }}">
                                <label for="brand_{{ $brand->brand_id }}">{{ $brand->brand_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="prd-filter-section">
                    <div class="prd-filter-header">DANH MỤC</div>
                    <div class="prd-filter-content">
                        @foreach ($categories as $category)
                            <div class="prd-filter-option">
                                <input type="checkbox" id="cat_{{ $category->category_id }}" name="categories[]"
                                    value="{{ $category->category_id }}">
                                <label for="cat_{{ $category->category_id }}">{{ $category->category_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="prd-content">
                <div class="prd-brands">
                    @foreach ($brands as $brand)
                        <div class="prd-brand-logo">
                            <img src="{{ asset($brand->brand_logo_url) }}" alt="{{ $brand->brand_name }}">
                        </div>
                    @endforeach
                </div>

                <div class="prd-section-header">
                    <h2 class="prd-section-title">
                        @if (isset($keyword))
                            Kết quả tìm kiếm cho: "{{ $keyword }}"
                        @else
                            VỢT CẦU LÔNG
                        @endif
                    </h2>
                    <div class="prd-sort-options">
                        <span>Sắp xếp:</span>
                        <select class="prd-sort-select" id="sortSelect">
                            <option value="">Mặc định</option>
                            <option value="price_asc">Giá tăng dần</option>
                            <option value="price_desc">Giá giảm dần</option>
                        </select>
                    </div>
                </div>

                <!-- PRODUCT LIST (AJAX TARGET) -->
                <div id="productList">
                    @include('user.page.product_list', ['products' => $products])
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function getFilterData() {
                const formData = new FormData();

                document.querySelectorAll('input[name="price_filters[]"]:checked').forEach(el => {
                    formData.append('price_filters[]', el.value);
                });

                document.querySelectorAll('input[name="brands[]"]:checked').forEach(el => {
                    formData.append('brands[]', el.value);
                });

                document.querySelectorAll('input[name="categories[]"]:checked').forEach(el => {
                    formData.append('categories[]', el.value);
                });

                const sortValue = document.getElementById('sortSelect').value;
                formData.append('sort_by', sortValue);

                return formData;
            }

            function fetchProducts() {
                const formData = getFilterData();

                fetch("{{ route('product.filter') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById("productList").innerHTML = html;
                    });
            }

            document.querySelectorAll('#filterForm input[type=checkbox]').forEach(input => {
                input.addEventListener('change', fetchProducts);
            });

            document.getElementById('sortSelect').addEventListener('change', fetchProducts);
        });
    </script>
@endsection
