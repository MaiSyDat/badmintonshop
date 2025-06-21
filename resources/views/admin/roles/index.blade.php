@extends('admin.master_layout.main')

@section('title', 'Quản lý phân quyền')

@section('main')
    <div class="col-md-12 main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý Quyền</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý Quyền</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm Quyền Mới
            </a>
        </div>

        <div class="search-section">
            <form action="{{ route('admin.roles.index') }}" method="GET" class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tìm kiếm</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Tìm theo tên quyền..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-funnel me-2"></i>Lọc
                    </button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle me-2"></i>Xóa lọc
                    </a>
                </div>
            </form>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách Quyền</h5>
                <span class="badge bg-secondary">Tổng: {{ $roles->total() }} quyền</span>
            </div>
            <div class="card-body p-0">
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
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">STT</th>
                                <th width="20%">Tên Quyền</th>
                                <th width="30%">Ngày tạo</th>
                                <th width="10%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $role)
                                <tr>
                                    <td>{{ $roles->firstItem() + $key }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="table-actions">
                                        <a href="{{ route('admin.roles.edit', $role->role_id) }}"
                                            class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <form action="{{ route('admin.roles.destroy', $role->role_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa quyền này không?');">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Không có quyền nào được tìm thấy.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Hiển thị {{ $roles->firstItem() }} - {{ $roles->lastItem() }} trong tổng số {{ $roles->total() }} kết quả
            </div>
            <nav aria-label="Phân trang">
                {{ $roles->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
@endsection
