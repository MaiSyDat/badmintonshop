@extends('admin.master_layout.main')

@section('title', 'Chỉnh sửa thương hiệu')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa thương hiệu</h1>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- Form -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data"
                    id="editBrandForm">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="form-section mb-4">
                        <h5 class="section-title">Thông tin cơ bản</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Tên thương hiệu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror"
                                        id="brand_name" name="brand_name"
                                        value="{{ old('brand_name', $brand->brand_name) }}" required>
                                    @error('brand_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Brand Logo -->
                    <div class="form-section mb-4">
                        <h5 class="section-title">Logo thương hiệu</h5>
                        <div class="mb-3">
                            <label for="brand_logo" class="form-label">Logo</label>
                            <input type="file" class="form-control @error('brand_logo') is-invalid @enderror"
                                id="brand_logo" name="brand_logo" accept="image/*">
                            <div class="form-text">Định dạng: JPG, JPEG, PNG, GIF. Kích thước tối đa: 2MB</div>
                            @error('brand_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="logoPreview" class="mt-2">
                            <img src="{{ asset('storage/' . $brand->brand_logo) }}" alt="{{ $brand->brand_name }}"
                                class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Lưu thay đổi
                        </button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/brands/create.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/admin/js/brands/create.js') }}"></script>
@endpush
