@extends('admin.master_layout.main')
@section('title')
    Thêm người dùng
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-14 main-content p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">
                            <i class="bi bi-person-plus text-primary me-2"></i>
                            Thêm người dùng mới
                        </h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="user-management.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="user-management.html">Quản lý người dùng</a>
                                </li>
                                <li class="breadcrumb-item active">Thêm mới</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.account.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Quay lại
                    </a>
                </div>

                <!-- Add User Form -->
                <form id="addUserForm" novalidate>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-8">
                            <!-- Thông tin cơ bản -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Thông tin cơ bản
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Tên đăng nhập" required maxlength="100">
                                            <label for="username">Tên đăng nhập <span class="required">*</span></label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập tên đăng nhập (tối đa 100 ký tự)
                                        </div>
                                        <div class="form-text">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Tên đăng nhập phải là duy nhất trong hệ thống
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email" required maxlength="255">
                                            <label for="email">Địa chỉ Email <span class="required">*</span></label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập địa chỉ email hợp lệ
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                placeholder="Họ và tên đầy đủ">
                                            <label for="full_name">Họ và tên đầy đủ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                                placeholder="Số điện thoại" maxlength="20">
                                            <label for="phone_number">Số điện thoại</label>
                                        </div>
                                        <div class="form-text">
                                            <i class="bi bi-telephone me-1"></i>
                                            Ví dụ: 0901234567 hoặc +84901234567
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="role_id" name="role_id" required>
                                                <option value="">Chọn chức vụ</option>
                                                <option value="1">Quản trị viên (Admin)</option>
                                                <option value="2">Quản lý (Manager)</option>
                                                <option value="3">Nhân viên (Staff)</option>
                                                <option value="4">Người dùng (User)</option>
                                                <option value="5">Khách hàng (Customer)</option>
                                            </select>
                                            <label for="role_id">Chức vụ <span class="required">*</span></label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Vui lòng chọn chức vụ cho người dùng
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Địa chỉ -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Thông tin địa chỉ
                                </h5>
                                <div class="form-floating">
                                    <textarea class="form-control" id="address" name="address" placeholder="Địa chỉ mặc định" style="height: 100px"
                                        maxlength="500"></textarea>
                                    <label for="address">Địa chỉ mặc định</label>
                                </div>
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Nhập địa chỉ đầy đủ: số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố
                                </div>
                            </div>

                            <!-- Bảo mật -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Thông tin bảo mật
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Mật khẩu" required minlength="8">
                                            <label for="password">Mật khẩu <span class="required">*</span></label>
                                        </div>
                                        <div class="password-strength" id="passwordStrength"></div>
                                        <div class="invalid-feedback">
                                            Mật khẩu phải có ít nhất 8 ký tự
                                        </div>
                                        <div class="form-text">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Mật khẩu nên chứa chữ hoa, chữ thường, số và ký tự đặc biệt
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                                            <label for="confirm_password">Xác nhận mật khẩu <span
                                                    class="required">*</span></label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Mật khẩu xác nhận không khớp
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-4">
                            <!-- Avatar Preview -->
                            <div class="form-section text-center">
                                <h5 class="section-title">
                                    <i class="bi bi-image me-2"></i>
                                    Ảnh đại diện
                                </h5>
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="bi bi-person"></i>
                                </div>
                                <input type="file" class="form-control" id="avatar" name="avatar"
                                    accept="image/*" style="display: none;">
                                <button type="button" class="btn btn-outline-primary"
                                    onclick="document.getElementById('avatar').click()">
                                    <i class="bi bi-camera me-2"></i>Chọn ảnh
                                </button>
                                <div class="form-text mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Định dạng: JPG, PNG. Kích thước tối đa: 2MB
                                </div>
                            </div>

                            <!-- Trạng thái tài khoản -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-toggle-on me-2"></i>
                                    Trạng thái tài khoản
                                </h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        checked>
                                    <label class="form-check-label" for="is_active">
                                        <span class="badge bg-success me-2">Kích hoạt</span>
                                        Tài khoản hoạt động
                                    </label>
                                </div>
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Tài khoản được kích hoạt có thể đăng nhập vào hệ thống
                                </div>
                            </div>

                            <!-- Thông tin hệ thống -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Thông tin hệ thống
                                </h5>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label class="form-label text-muted">User ID (UUID)</label>
                                        <input type="text" class="form-control-plaintext" value="Sẽ được tạo tự động"
                                            readonly>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-muted">Ngày tạo</label>
                                        <input type="text" class="form-control-plaintext" value="Hiện tại" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-muted">Cập nhật</label>
                                        <input type="text" class="form-control-plaintext" value="Hiện tại" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="user-management.html" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-x-circle me-2"></i>Hủy bỏ
                                </a>
                                <button type="reset" class="btn btn-outline-warning btn-lg">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg btn-save">
                                    <i class="bi bi-check-circle me-2"></i>Thêm người dùng
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle me-2"></i>Thành công
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Thêm người dùng thành công!</h4>
                    <p class="text-muted">Người dùng mới đã được thêm vào hệ thống.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a href="user-management.html" class="btn btn-primary">Về danh sách</a>
                </div>
            </div>
        </div>
    </div>

@section('sctipt')
    <script src="/assets/js/admin/account.js"></script>
@endsection
@endsection
