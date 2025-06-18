@extends('user.master_latout.main')
@section('main')
    <div class="auth-container">
        <div class="grid wide">
            <div class="row">
                <!-- Left Panel - Benefits -->
                <div class="auth-left col col l-6 m-6 c-6">
                    <div class="auth-left-panel">
                        <div class="auth-left-content">
                            <h2 class="auth-left-title">Tạo mật khẩu mới</h2>

                            <div class="auth-benefit">
                                <i class="fas fa-key auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Tạo mật khẩu mạnh để bảo vệ tài khoản</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-shield-alt auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Sử dụng ít nhất 8 ký tự với chữ hoa, chữ thường và số</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-check-circle auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Mật khẩu mới sẽ có hiệu lực ngay lập tức</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-user-shield auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Tài khoản của bạn sẽ được bảo mật tối đa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Reset Password Form -->
                <div class="col l-6 m-12 c-12">
                    <div class="auth-right-panel">
                        <div class="auth-form-container">

                            <h3 class="auth-title">Đặt lại mật khẩu</h3>

                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Email -->
                                <div class="auth-form-group">
                                    <input type="email" class="auth-input @error('email') error @enderror" name="email"
                                        value="{{ old('email', $request->email) }}" placeholder="E-mail" required>
                                    @error('email')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="auth-form-group">
                                    <input type="password" class="auth-input @error('password') error @enderror"
                                        name="password" id="resetPassword" placeholder="Mật khẩu mới" required>
                                    <button type="button" class="auth-password-toggle"
                                        onclick="togglePassword('resetPassword', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="auth-form-group">
                                    <input type="password"
                                        class="auth-input @error('password_confirmation') error @enderror"
                                        name="password_confirmation" placeholder="Xác nhận mật khẩu mới" required>
                                    @error('password_confirmation')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="auth-btn-primary">
                                    Đặt lại mật khẩu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }
    </script>
@endsection
