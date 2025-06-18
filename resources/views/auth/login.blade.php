@extends('user.master_latout.main')
@section('main')
    <div class="auth-container">
        <div class="grid wide">
            <div class="row">
                <!-- Left Panel - Benefits -->
                <div class="auth-left col l-6 m-6 c-6">
                    <div class="auth-left-panel">
                        <div class="auth-left-content">
                            <h2 class="auth-left-title">Chào mừng trở lại BadmintonShop</h2>

                            <div class="auth-benefit">
                                <i class="fas fa-bookmark auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Truy cập bộ sưu tập vợt cầu lông yêu thích của bạn</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-shopping-cart auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Theo dõi đơn hàng và lịch sử mua hàng</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-heart auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Lưu sản phẩm yêu thích để mua sau</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-gift auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Nhận ưu đãi và khuyến mãi độc quyền</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Login Form -->
                <div class="col l-6 m-12 c-12">
                    <div class="auth-right-panel">
                        <div class="auth-form-container">

                            <h3 class="auth-title">Đăng nhập tài khoản</h3>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="auth-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="auth-form-group">
                                    <input type="email" class="auth-input @error('email') error @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="E-mail" required>
                                    @error('email')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="auth-form-group">
                                    <input type="password" class="auth-input @error('password') error @enderror"
                                        name="password" id="loginPassword" placeholder="Mật khẩu" required>
                                    <button type="button" class="auth-password-toggle"
                                        onclick="togglePassword('loginPassword', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="auth-checkbox-group">
                                    <input type="checkbox" class="auth-checkbox" id="remember" name="remember">
                                    <label class="auth-checkbox-label" for="remember">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>

                                <!-- Login Button -->
                                <button type="submit" class="auth-btn-primary">
                                    Đăng nhập
                                </button>
                            </form>

                            <!-- Forgot Password -->
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link auth-forgot-link">Quên mật
                                    khẩu?</a>
                            @endif

                            <!-- Social Login -->
                            <button class="auth-btn-social">
                                <i class="fab fa-google"></i>
                                Tiếp tục bằng tài khoản Google
                            </button>
                            <button class="auth-btn-social">
                                <i class="fab fa-facebook-f"></i>
                                Tiếp tục bằng tài khoản Facebook
                            </button>

                            <!-- Register Link -->
                            <p class="auth-text-center">
                                Chưa có tài khoản? <a href="{{ route('register') }}" class="auth-link">Đăng ký ngay</a>
                            </p>
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
