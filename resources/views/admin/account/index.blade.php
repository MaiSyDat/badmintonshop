@extends('admin.master_layout.main')
@section('title')
    Quản lý tài khoản
@endsection
@section('main')
    <!-- Main Content -->
    <div class="col-md-12 main-content p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Quản lý người dùng</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý người dùng</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.account.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i>Thêm người dùng
            </a>
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
                <h5 class="mb-0">Danh sách người dùng</h5>
                <span class="badge bg-secondary">Tổng: 156 người dùng</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Tên</th>
                                <th width="20%">Email</th>
                                <th width="20%">Địa chỉ</th>
                                <th width="10%">Trạng thái</th>
                                <th width="15%">Chức vụ</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">NT</div>
                                        <div>
                                            <div class="fw-semibold">Nguyễn Văn Thành</div>
                                            <small class="text-muted">ID: #001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>thanh.nguyen@email.com</td>
                                <td>123 Đường ABC, Quận 1, TP.HCM</td>
                                <td><span class="badge bg-success status-badge">Hoạt động</span></td>
                                <td><span class="badge bg-primary">Quản trị viên</span></td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">LH</div>
                                        <div>
                                            <div class="fw-semibold">Lê Thị Hương</div>
                                            <small class="text-muted">ID: #002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>huong.le@email.com</td>
                                <td>456 Đường XYZ, Quận 3, TP.HCM</td>
                                <td><span class="badge bg-success status-badge">Hoạt động</span></td>
                                <td><span class="badge bg-info">Quản lý</span></td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">TD</div>
                                        <div>
                                            <div class="fw-semibold">Trần Minh Đức</div>
                                            <small class="text-muted">ID: #003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>duc.tran@email.com</td>
                                <td>789 Đường DEF, Quận 7, TP.HCM</td>
                                <td><span class="badge bg-warning status-badge">Chờ duyệt</span></td>
                                <td><span class="badge bg-secondary">Người dùng</span></td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">PL</div>
                                        <div>
                                            <div class="fw-semibold">Phạm Thị Lan</div>
                                            <small class="text-muted">ID: #004</small>
                                        </div>
                                    </div>
                                </td>
                                <td>lan.pham@email.com</td>
                                <td>321 Đường GHI, Quận 5, TP.HCM</td>
                                <td><span class="badge bg-danger status-badge">Không hoạt động</span></td>
                                <td><span class="badge bg-secondary">Người dùng</span></td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">VK</div>
                                        <div>
                                            <div class="fw-semibold">Võ Minh Khang</div>
                                            <small class="text-muted">ID: #005</small>
                                        </div>
                                    </div>
                                </td>
                                <td>khang.vo@email.com</td>
                                <td>654 Đường JKL, Quận 2, TP.HCM</td>
                                <td><span class="badge bg-success status-badge">Hoạt động</span></td>
                                <td><span class="badge bg-info">Quản lý</span></td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Sửa">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <i class="bi bi-trash"></i>
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
