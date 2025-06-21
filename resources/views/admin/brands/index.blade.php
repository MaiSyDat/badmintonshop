@extends('admin.master_layout.main')

@section('title', 'Quản lý thương hiệu')

@section('main')
    <div class="col-md-12 main-content p-4">
        <!-- Page header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý thương hiệu</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý thương hiệu</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm thương hiệu
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.brands.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Lọc
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle me-2"></i>Xóa lọc
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Brand List -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th width="10%">Logo</th>
                                <th width="20%">Tên thương hiệu</th>
                                <th width="20%">Ngày tạo</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as $key => $brand)
                                <tr>
                                    <td>{{ $brands->firstItem() + $key }}</td>
                                    <td>
                                        @if ($brand->brand_logo_url)
                                            <img src="{{ asset($brand->brand_logo_url) }}" alt="{{ $brand->brand_name }}"
                                                class="brand-logo" style="max-width: 50px; height: auto;">
                                        @else
                                            Không có logo
                                        @endif
                                    </td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>{{ $brand->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.brands.edit', $brand->brand_id) }}"
                                                class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.brands.destroy', $brand->brand_id) }}"
                                                method="POST" class="d-inline ms-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?');">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="bi bi-emoji-frown fs-1"></i>
                                            <p class="mt-2">Không tìm thấy thương hiệu nào</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/brands/index.css') }}">
    <style>
        .brand-logo {
            border-radius: 5px;
            object-fit: contain;
            border: 1px solid #e0e0e0;
            padding: 3px;
        }
    </style>
@endpush
