@extends('admin.master_layout.main')
@section('title')
    Quản lý danh mục
@endsection
@section('main')
    <!-- Main Content -->
    <div class="col-md-12 main-content p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý danh mục</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý danh mục</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bx bx-plus"></i>Thêm danh mục
            </button>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tìm kiếm</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Tìm theo tên, email...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Không hoạt động</option>
                        <option value="pending">Chờ duyệt</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Chức vụ</label>
                    <select class="form-select">
                        <option value="">Tất cả chức vụ</option>
                        <option value="admin">Quản trị viên</option>
                        <option value="manager">Quản lý</option>
                        <option value="user">Người dùng</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-outline-primary w-100">
                        <i class="bi bi-funnel me-2"></i>Lọc
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách danh mục</h5>
                <span class="badge bg-secondary">Tổng: 156 danh mục</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Tên</th>
                                <th width="20%">Trạng thái</th>
                                <th width="20%">Ngày tạo</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-semibold">Vợt cầu long cho người mới</div>
                                            <small class="text-muted">ID: #001</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success status-badge">Hoạt động</span></td>
                                <td><span class="created_at">10/20/2025</span></td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Hiển thị 1-5 trong tổng số 156 kết quả
            </div>
            <nav aria-label="Phân trang">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">32</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
ư
