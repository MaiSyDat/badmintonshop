@extends('admin.master_layout.main')

@section('title', 'Chỉnh sửa danh mục: ' . $category->category_name)

@section('main')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa danh mục: {{ $category->category_name }}</h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')

                    <div class="form-section mb-4">
                        <h5 class="section-title">Thông tin cơ bản</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Tên danh mục <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                        id="category_name" name="category_name"
                                        value="{{ old('category_name', $category->category_name) }}" required>
                                    @error('category_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Cập nhật danh mục
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
