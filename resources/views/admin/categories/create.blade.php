@extends('admin.master_layout.main')

@section('title', 'Thêm danh mục mới')

@section('main')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm danh mục mới</h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                {{-- Đảm bảo form action đúng với route store, bỏ enctype nếu không upload file --}}
                <form action="{{ route('admin.categories.store') }}" method="POST" id="createCategoryForm">
                    @csrf

                    <div class="form-section mb-4">
                        <h5 class="section-title">Thông tin cơ bản</h5>
                        <div class="row">
                            <div class="col-md-12"> {{-- Thay đổi thành col-md-12 vì chỉ còn 1 cột chính --}}
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Tên danh mục <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                        id="category_name" name="category_name" value="{{ old('category_name') }}" required>
                                    @error('category_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Đã loại bỏ category_slug --}}
                        </div>

                        <div class="mb-3">
                            {{-- Đã đổi name từ category_description thành description để khớp với DB --}}
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Đã loại bỏ parent_id, category_image, is_active --}}
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Lưu danh mục
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Nếu bạn không dùng các CSS cụ thể cho các trường đã bỏ, có thể xóa file này hoặc giữ lại nếu nó chứa style chung --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categories/create.css') }}">
@endpush

@push('scripts')
    {{-- Nếu script này có liên quan đến các trường đã bỏ, bạn cần cập nhật hoặc xóa nó --}}
    <script src="{{ asset('assets/admin/js/categories/create.js') }}"></script>
@endpush
