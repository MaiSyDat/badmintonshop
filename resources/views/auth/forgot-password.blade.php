@extends('user.master_latout.main')
@section('main')
    <div class="auth-container">
        <div class="grid wide">
            <div class="row">
                <!-- Left Panel - Benefits -->
                <div class="auth-left col col l-6 m-6 c-6">
                    <div class="auth-left-panel">
                        <div class="auth-left-content">
                            <h2 class="auth-left-title">Khôi phục mật khẩu</h2>

                            <div class="auth-benefit">
                                <i class="fas fa-shield-alt auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Bảo mật tài khoản của bạn là ưu tiên hàng đầu</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-envelope auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Chúng tôi sẽ gửi link khôi phục qua email</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-clock auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Link khôi phục có hiệu lực trong 60 phút</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-lock auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Quy trình khôi phục hoàn toàn an toàn</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Forgot Password Form -->
                <div class="col l-6 m-12 c-12">
                    <div class="auth-right-panel">
                        <div class="auth-form-container">

                            <h3 class="auth-title">Quên mật khẩu?</h3>
                            <p class="auth-subtitle">Nhập email của bạn và chúng tôi sẽ gửi link để đặt lại mật khẩu.</p>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="auth-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <!-- Email -->
                                <div class="auth-form-group">
                                    <input type="email" class="auth-input @error('email') error @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="E-mail" required>
                                    @error('email')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="auth-btn-primary">
                                    Gửi link khôi phục
                                </button>
                            </form>

                            <!-- Back to Login -->
                            <p class="auth-text-center">
                                <a href="{{ route('login') }}" class="auth-back-link">
                                    <i class="fas fa-arrow-left"></i>
                                    Quay lại đăng nhập
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
