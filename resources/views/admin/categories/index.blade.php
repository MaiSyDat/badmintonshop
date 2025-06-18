@extends('admin.master_layout.main')

@section('title', 'Quản lý danh mục')

@section('main')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quản lý danh mục</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Thêm danh mục
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.categories.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search"
                                placeholder="Tìm kiếm theo tên hoặc slug..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    {{-- Các trường search và filter này phụ thuộc vào việc bạn có thêm cột slug và status vào DB không --}}
                    <div class="col-md-3">
                        <select class="form-select" name="status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Lọc
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success mx-3 mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger mx-3 mt-3">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $key }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td> {{-- Hiển thị ngày tạo --}}
                                    <td>
                                        <div class="btn-group">
                                            {{-- Link Sửa: $category tự động dùng category_id vì đã cấu hình getRouteKeyName() --}}
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            {{-- FORM XÓA DANH MỤC --}}
                                            <form action="{{ route('admin.categories.destroy', $category->category_id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                            {{-- KẾT THÚC FORM XÓA DANH MỤC --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4"> {{-- Đảm bảo colspan đúng số cột --}}
                                        <div class="empty-state">
                                            <i class="bi bi-emoji-frown fs-1"></i>
                                            <p class="mt-2">Không tìm thấy danh mục nào</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categories/index.css') }}">
@endpush

@push('scripts')
    <script>
        function deleteCategory(categoryId) {
            if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
                fetch(`/admin/categories/${categoryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi xóa danh mục');
                    });
            }
        }
    </script>
@endpush
