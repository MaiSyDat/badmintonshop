@extends('admin.master_layout.main')
@section('title')
    Thêm người dùng
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-14 main-content p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">
                            <i class="bi bi-person-plus text-primary me-2"></i>
                            Thêm người dùng mới
                        </h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.account.index') }}">Quản lý người dùng</a>
                                </li>
                                <li class="breadcrumb-item active">Thêm mới</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.account.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Quay lại
                    </a>
                </div>

                {{-- THAY ĐỔI Ở ĐÂY --}}
                <form id="addUserForm" action="{{ route('admin.account.store') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf {{-- ĐỪNG QUÊN DÒNG NÀY --}}

                    {{-- HIỂN THỊ LỖI CHUNG --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Thông tin cơ bản
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                name="username" placeholder="Tên đăng nhập" required maxlength="100"
                                                value="{{ old('username') }}">
                                            <label for="username">Tên đăng nhập <span class="required">*</span></label>
                                        </div>
                                        @error('username')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @else
                                            <div class="form-text">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Tên đăng nhập phải là duy nhất trong hệ thống
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Email" required maxlength="255"
                                                value="{{ old('email') }}">
                                            <label for="email">Địa chỉ Email <span class="required">*</span></label>
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                                                name="full_name" placeholder="Họ và tên đầy đủ"
                                                value="{{ old('full_name') }}">
                                            <label for="full_name">Họ và tên đầy đủ</label>
                                        </div>
                                        @error('full_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                id="phone_number" name="phone_number" placeholder="Số điện thoại"
                                                maxlength="20" value="{{ old('phone_number') }}">
                                            <label for="phone_number">Số điện thoại</label>
                                        </div>
                                        <div class="form-text">
                                            <i class="bi bi-telephone me-1"></i>
                                            Ví dụ: 0901234567 hoặc +84901234567
                                        </div>
                                        @error('phone_number')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select @error('role_id') is-invalid @enderror"
                                                id="role_id" name="role_id" required>
                                                <option value="">Chọn chức vụ</option>
                                                @foreach ($roles as $role)
                                                    {{-- CHÚ Ý: CHÚNG TA SẼ TRUYỀN BIẾN $roles TỪ CONTROLLER --}}
                                                    <option value="{{ $role->role_id }}"
                                                        {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                                        {{ $role->role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="role_id">Chức vụ <span class="required">*</span></label>
                                        </div>
                                        @error('role_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Thông tin địa chỉ
                                </h5>
                                <div class="form-floating">
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                        placeholder="Địa chỉ mặc định" style="height: 100px" maxlength="500">{{ old('address') }}</textarea>
                                    <label for="address">Địa chỉ mặc định</label>
                                </div>
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Nhập địa chỉ đầy đủ: số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố
                                </div>
                                @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Thông tin bảo mật
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="Mật khẩu" required
                                                minlength="8">
                                            <label for="password">Mật khẩu <span class="required">*</span></label>
                                        </div>
                                        <div class="password-strength" id="passwordStrength"></div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @else
                                            <div class="form-text">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Mật khẩu nên chứa chữ hoa, chữ thường, số và ký tự đặc biệt
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="confirm_password" name="password_confirmation"
                                                placeholder="Xác nhận mật khẩu" required> {{-- ĐỔI TÊN THÀNH password_confirmation --}}
                                            <label for="confirm_password">Xác nhận mật khẩu <span
                                                    class="required">*</span></label>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-section text-center">
                                <h5 class="section-title">
                                    <i class="bi bi-image me-2"></i>
                                    Ảnh đại diện
                                </h5>
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="bi bi-person"></i>
                                </div>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                    id="avatar" name="avatar" accept="image/*" style="display: none;">
                                <button type="button" class="btn btn-outline-primary"
                                    onclick="document.getElementById('avatar').click()">
                                    <i class="bi bi-camera me-2"></i>Chọn ảnh
                                </button>
                                <div class="form-text mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Định dạng: JPG, PNG. Kích thước tối đa: 2MB
                                </div>
                                @error('avatar')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-toggle-on me-2"></i>
                                    Trạng thái tài khoản
                                </h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        checked {{ old('is_active', true) ? 'checked' : '' }}> {{-- Giữ trạng thái khi có lỗi --}}
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

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.account.index') }}" class="btn btn-outline-secondary btn-lg">
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

    {{-- Modal này sẽ được kích hoạt bằng JS sau khi submit form thành công qua AJAX --}}
    {{-- Hoặc bạn có thể dùng Flash Message của Laravel --}}
    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalLabel">
                            <i class="bi bi-check-circle me-2"></i>Thành công
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">{{ session('success') }}</h4>
                        <p class="text-muted">Người dùng mới đã được thêm vào hệ thống.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <a href="{{ route('admin.account.index') }}" class="btn btn-primary">Về danh sách</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('sctipt')
    {{-- <script src="/assets/js/admin/account.js"></script> --}}
@endsection
