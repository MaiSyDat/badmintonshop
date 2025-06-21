@php
    $colors = ['Đen', 'Trắng', 'Xanh dương', 'Đỏ', 'Vàng', 'Bạc'];
    $weights = ['3U (85-89g)', '4U (80-84g)', '5U (75-79g)'];
    $lengths = ['675mm', '680mm', '685mm'];
    $grips = ['G4', 'G5', 'G6'];
    $lbsOptions = ['20-22 lbs', '22-24 lbs', '24-26 lbs', '26-28 lbs'];
    $materials = ['Carbon', 'Graphite', 'Titanium', 'Aluminum'];
    $stiffnessOptions = ['Dẻo', 'Trung bình', 'Cứng'];
    $balanceOptions = ['Nặng đầu', 'Cân bằng', 'Nặng tay cầm', 'Siêu nặng đầu', 'Siêu nhẹ đầu'];
    $extend = $product->product_extend ?? null;
@endphp

@extends('admin.master_layout.main')

@section('main')
    <div class="container">
        <h2>Thêm sản phẩm mới</h2>

        <!-- Hiển thị lỗi nếu có -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Thông tin cơ bản -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-info-circle me-2"></i>
                    Thông Tin Cơ Bản
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_name" class="form-label fw-bold">
                                <i class="fas fa-tag me-1"></i>
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="product_name" id="product_name" class="form-control form-control-lg"
                                value="{{ old('product_name', $product->product_name) }}" placeholder="Nhập tên sản phẩm"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sku" class="form-label fw-bold">
                                <i class="fas fa-barcode me-1"></i>
                                Mã SKU <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="sku" id="sku" class="form-control form-control-lg"
                                value="{{ old('sku', optional($product->product_extend)->sku) }}" placeholder="Nhập mã SKU"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="base_price" class="form-label fw-bold">
                                <i class="fas fa-dollar-sign me-1"></i>
                                Giá gốc <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="base_price" id="base_price"
                                    class="form-control form-control-lg" placeholder="0.00"
                                    value="{{ old('base_price', $product->base_price) }}" required>
                                <span class="input-group-text">VNĐ</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="discount" class="form-label fw-bold">
                                <i class="fas fa-percent me-1"></i>
                                Giảm giá
                            </label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="discount" id="discount"
                                    class="form-control form-control-lg" placeholder="0.00"
                                    value="{{ old('discount', optional($product->product_extend)->discount) }}">
                                <span class="input-group-text">VNĐ</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="brand_id" class="form-label fw-bold">
                                <i class="fas fa-copyright me-1"></i>
                                Thương hiệu <span class="text-danger">*</span>
                            </label>
                            <select name="brand_id" id="brand_id" class="form-select form-select-lg" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->brand_id }}"
                                        {{ old('brand_id', $product->brand_id) == $brand->brand_id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold">
                                <i class="fas fa-list me-1"></i>
                                Danh mục <span class="text-danger">*</span>
                            </label>
                            <select name="category_id" id="category_id" class="form-select form-select-lg" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}"
                                        {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="is_active" class="form-label fw-bold">
                                <i class="fas fa-eye me-1"></i>
                                Trạng thái
                            </label>
                            <select name="is_active" id="is_active" class="form-select form-select-lg">
                                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>
                                    Hiển thị
                                </option>
                                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>
                                    Ẩn
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label fw-bold">
                        <i class="fas fa-boxes me-1"></i>
                        Số lượng trong kho
                    </label>
                    <input type="number" name="quantity" id="quantity" class="form-control form-control-lg"
                        placeholder="Nhập số lượng"
                        value="{{ old('quantity', optional($product->product_extend)->quantity) }}">
                </div>
            </div>

            <!-- Hình ảnh -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-images me-2"></i>
                    Hình Ảnh Sản Phẩm
                </h4>

                <div class="row">
                    <!-- Ảnh đại diện (main_image) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="main_image" class="form-label fw-bold">
                                <i class="fas fa-image me-1"></i>
                                Ảnh đại diện <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="main_image" id="main_image" class="form-control form-control-lg"
                                accept="image/*">
                            @if ($product->main_image_url)
                                <div class="mt-2">
                                    <img src="{{ asset($product->main_image_url) }}" alt="Ảnh hiện tại"
                                        class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ảnh chi tiết (product_images) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail_imgs" class="form-label fw-bold">
                                <i class="fas fa-images me-1"></i>
                                Ảnh chi tiết (có thể chọn nhiều ảnh)
                            </label>
                            <input type="file" name="detail_imgs[]" id="detail_imgs"
                                class="form-control form-control-lg" accept="image/*" multiple>

                            @if ($product->images->isNotEmpty())
                                <div class="mt-2 d-flex flex-wrap gap-2">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset($image->path) }}" alt="Ảnh chi tiết" class="img-thumbnail"
                                            style="max-height: 100px;">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-align-left me-2"></i>
                    Mô Tả Sản Phẩm
                </h4>

                <div class="mb-3">
                    <label for="short_description" class="form-label fw-bold">
                        <i class="fas fa-file-alt me-1"></i>
                        Mô tả ngắn
                    </label>
                    <textarea name="short_description" id="short_description" class="form-control" rows="3"
                        placeholder="Nhập mô tả ngắn về sản phẩm...">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="long_description" class="form-label fw-bold">
                        <i class="fas fa-file-text me-1"></i>
                        Mô tả chi tiết
                    </label>
                    <textarea name="long_description" id="long_description" class="form-control" rows="6"
                        placeholder="Nhập mô tả chi tiết về sản phẩm...">{{ old('long_description', $product->long_description) }}</textarea>
                </div>
            </div>

            <!-- Thông số kỹ thuật -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-cogs me-2"></i>
                    Thông Số Kỹ Thuật
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="color" class="form-label fw-bold">
                                <i class="fas fa-palette me-1"></i> Màu sắc <span class="text-danger">*</span>
                            </label>
                            <select name="color" id="color" class="form-select form-select-lg" required>
                                <option value="">-- Chọn màu --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color }}"
                                        {{ old('color', $extend->color ?? '') == $color ? 'selected' : '' }}>
                                        {{ $color }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="weight_WU" class="form-label fw-bold">
                                <i class="fas fa-weight me-1"></i> Trọng lượng <span class="text-danger">*</span>
                            </label>
                            <select name="weight_WU" id="weight_WU" class="form-select form-select-lg" required>
                                <option value="">-- Chọn trọng lượng --</option>
                                @foreach ($weights as $weight)
                                    <option value="{{ $weight }}"
                                        {{ old('weight_WU', $extend->weight_WU ?? '') == $weight ? 'selected' : '' }}>
                                        {{ $weight }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="length" class="form-label fw-bold">
                                <i class="fas fa-ruler me-1"></i> Chiều dài <span class="text-danger">*</span>
                            </label>
                            <select name="length" id="length" class="form-select form-select-lg" required>
                                <option value="">-- Chọn chiều dài --</option>
                                @foreach ($lengths as $length)
                                    <option value="{{ $length }}"
                                        {{ old('length', $extend->length ?? '') == $length ? 'selected' : '' }}>
                                        {{ $length }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="grip_size_G" class="form-label fw-bold">
                                <i class="fas fa-hand-paper me-1"></i> Kích thước cán <span class="text-danger">*</span>
                            </label>
                            <select name="grip_size_G" id="grip_size_G" class="form-select form-select-lg" required>
                                <option value="">-- Chọn kích thước cán --</option>
                                @foreach ($grips as $grip)
                                    <option value="{{ $grip }}"
                                        {{ old('grip_size_G', $extend->grip_size_G ?? '') == $grip ? 'selected' : '' }}>
                                        {{ $grip }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lbs" class="form-label fw-bold">
                                <i class="fas fa-dumbbell me-1"></i> Sức căng (lbs) <span class="text-danger">*</span>
                            </label>
                            <select name="lbs" id="lbs" class="form-select form-select-lg" required>
                                <option value="">-- Chọn sức căng --</option>
                                @foreach ($lbsOptions as $lbs)
                                    <option value="{{ $lbs }}"
                                        {{ old('lbs', $extend->lbs ?? '') == $lbs ? 'selected' : '' }}>
                                        {{ $lbs }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="material" class="form-label fw-bold">
                                <i class="fas fa-atom me-1"></i> Chất liệu <span class="text-danger">*</span>
                            </label>
                            <select name="material" id="material" class="form-select form-select-lg" required>
                                <option value="">-- Chọn chất liệu --</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material }}"
                                        {{ old('material', $extend->material ?? '') == $material ? 'selected' : '' }}>
                                        {{ $material }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="balance" class="form-label fw-bold">
                                <i class="fas fa-balance-scale me-1"></i> Độ cân bằng <span class="text-danger">*</span>
                            </label>
                            <select name="balance" id="balance" class="form-select form-select-lg" required>
                                <option value="">-- Chọn độ cân bằng --</option>
                                @foreach ($balanceOptions as $balance)
                                    <option value="{{ $balance }}"
                                        {{ old('balance', $extend->balance ?? '') == $balance ? 'selected' : '' }}>
                                        {{ $balance }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="stiffness" class="form-label fw-bold">
                                <i class="fas fa-thermometer-half me-1"></i> Độ cứng <span class="text-danger">*</span>
                            </label>
                            <select name="stiffness" id="stiffness" class="form-select form-select-lg" required>
                                <option value="">-- Chọn độ cứng --</option>
                                @foreach ($stiffnessOptions as $stiffness)
                                    <option value="{{ $stiffness }}"
                                        {{ old('stiffness', $extend->stiffness ?? '') == $stiffness ? 'selected' : '' }}>
                                        {{ $stiffness }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Nút submit -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-outline-secondary btn-lg me-md-2">
                    <i class="fas fa-undo me-2"></i>
                    Đặt lại
                </button>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>
                    Lưu sản phẩm
                </button>
            </div>
        </form>
    </div>
@endsection
