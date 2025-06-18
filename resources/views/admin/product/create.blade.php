@extends('admin.master_layout.main')

@section('main')
    <div class="container">
        <h2>Thêm sản phẩm mới</h2>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tên sản phẩm -->
            <input type="text" name="product_name" class="form-control my-2" placeholder="Tên sản phẩm">

            <!-- Giá cơ bản -->
            <input type="number" step="0.01" name="base_price" class="form-control my-2" placeholder="Giá gốc">

            <!-- Ảnh đại diện -->
            <label class="mt-2">Ảnh đại diện:</label>
            <input type="file" name="main_image" class="form-control mb-2">

            <!-- Thương hiệu -->
            <label>Thương hiệu:</label>
            <select name="brand_id" class="form-control mb-2">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                @endforeach
            </select>

            <!-- Danh mục -->
            <label>Danh mục:</label>
            <select name="category_id" class="form-control mb-3">
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>

            <hr>
            <h4>Biến thể sản phẩm</h4>
            <div id="variant-container">
                <div class="variant-group border p-3 mb-3 rounded">
                    <input type="text" name="variants[0][sku]" class="form-control mb-2" placeholder="SKU">
                    <input type="number" step="0.01" name="variants[0][discount_price]" class="form-control mb-2"
                        placeholder="Giảm giá (ví dụ: 50000)">
                    <input type="number" name="variants[0][stock_quantity]" class="form-control mb-2"
                        placeholder="Số lượng tồn kho">
                    <label>Ảnh biến thể:</label>
                    <input type="file" name="variants[0][variant_image]" class="form-control mb-2">

                    @foreach ($attributes as $attr)
                        <label>{{ $attr->attribute_name }}:</label>
                        <select name="variants[0][attributes][]" class="form-control mb-2">
                            @foreach ($attr->values as $value)
                                <option value="{{ $value->value_id }}">{{ $value->attribute_value }}</option>
                            @endforeach
                        </select>
                    @endforeach
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="addVariant()">+ Thêm biến thể</button>

            <br><br>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>

    <script>
        let variantIndex = 1;

        function addVariant() {
            const container = document.getElementById('variant-container');
            const template = container.querySelector('.variant-group').outerHTML;

            // Thay tất cả [0] thành [variantIndex]
            const newHtml = template.replaceAll(/\[0\]/g, `[${variantIndex}]`);
            container.insertAdjacentHTML('beforeend', newHtml);
            variantIndex++;
        }
    </script>
@endsection
