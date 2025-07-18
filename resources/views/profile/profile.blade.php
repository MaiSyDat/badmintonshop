@extends('user.master_latout.main')

@section('title', 'Trang cá nhân')

@section('main')

    <div class="dashboard-container">
        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <!-- Profile Section -->
                <div id="profile-section" class="content-section active">
                    <div class="section-header">
                        <h1>Thông tin cá nhân</h1>
                        <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="profile-card">
                        <form id="profile-form" class="profile-form" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="grid wide">
                                <div class="row">
                                    <div class="col c-12 l-6">
                                        <div class="form-group">
                                            <label for="username">Tên đăng nhập <span class="required">*</span></label>
                                            <input type="text" id="username" name="username" required maxlength="100"
                                                value="{{ old('username', $user->username) }}">
                                        </div>
                                    </div>
                                    <div class="col c-12 l-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input type="email" id="email" name="email" required maxlength="255"
                                                value="{{ old('email', $user->email) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col c-12 l-6">
                                        <div class="form-group">
                                            <label for="full_name">Họ và tên</label>
                                            <input type="text" id="full_name" name="full_name"
                                                value="{{ old('full_name', $user->full_name) }}">
                                        </div>
                                    </div>
                                    <div class="col c-12 l-6">
                                        <div class="form-group">
                                            <label for="phone_number">Số điện thoại</label>
                                            <input type="tel" id="phone_number" name="phone_number" maxlength="20"
                                                value="{{ old('phone_number', $user->phone_number) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col c-12">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <textarea id="address" name="address" rows="3" maxlength="500" placeholder="Nhập địa chỉ của bạn">{{ old('address', $user->address) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col c-12 l-6">
                                        <div class="form-group">
                                            <label class="checkbox-label">
                                                <input type="checkbox" id="is_active" name="is_active"
                                                    {{ $user->is_active ? 'checked' : '' }} disabled>
                                                <span class="checkmark"></span>
                                                Tài khoản đang hoạt động
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col c-12">
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i>
                                                Lưu thay đổi
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                <i class="fas fa-undo"></i>
                                                Hủy bỏ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
