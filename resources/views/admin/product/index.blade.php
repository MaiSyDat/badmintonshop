@extends('admin.master_layout.main')
@section('title')
    Quản lý sản phẩm
@endsection
@section('main')
    <div class="col-md-12 main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý sản phẩm</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm sản phẩm
            </a>
        </div>

        <div class="search-section">
            <form action="{{ route('admin.product.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tìm kiếm</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Tìm theo tên sản phẩm..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select" name="category_id">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Thương hiệu</label>
                        <select class="form-select" name="brand_id">
                            <option value="">Tất cả thương hiệu</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->brand_id }}"
                                    {{ request('brand_id') == $brand->brand_id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="bi bi-funnel me-2"></i>Lọc
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách sản phẩm</h5>
                {{-- <span class="badge bg-secondary">Tổng: {{ $products->total() }} sản phẩm</span> --}}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Hình ảnh</th>
                                <th width="20%">Tên sản phẩm</th>
                                <th width="15%">Danh mục</th>
                                <th width="15%">Thương hiệu</th>
                                <th width="10%">Giá</th>
                                <th width="10%">Trạng thái</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $key }}</td>
                                    <td>
                                        @if ($product->main_image_url)
                                            <img src="{{ asset('storage/' . $product->main_image_url) }}"
                                                alt="{{ $product->product_name }}" class="product-thumbnail"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="product-thumbnail-placeholder d-flex align-items-center justify-content-center bg-light"
                                                style="width: 60px; height: 60px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $product->product_name }}</div>
                                        <small class="text-muted">SKU:
                                            {{ $product->variants->first()->sku ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $product->category->category_name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $product->brand->brand_name }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-primary">
                                            {{ number_format($product->base_price) }}₫
                                        </div>
                                        @if ($product->variants->count() > 1)
                                            <small class="text-muted">{{ $product->variants->count() }} biến thể</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->is_active)
                                            <span class="badge bg-success status-badge">Đang bán</span>
                                        @else
                                            <span class="badge bg-danger status-badge">Ngừng bán</span>
                                        @endif
                                    </td>
                                    <td class="table-actions">
                                        <a href="{{ route('admin.product.edit', $product->product_id) }}"
                                            class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <form action="{{ route('admin.product.destroy', $product->product_id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có sản phẩm nào được tìm thấy.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ $products->firstItem() }} - {{ $products->lastItem() }}
                {{ $products->total() }}
            </div>
            <nav aria-label="Phân trang">
                {{ $products->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .product-thumbnail {
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .product-thumbnail-placeholder {
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .table-actions {
            white-space: nowrap;
        }

        .table-actions .btn {
            padding: 0.25rem 0.5rem;
        }
    </style>
@endpush
