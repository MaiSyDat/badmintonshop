@extends('user.master_latout.main')
@section('main')
    <div class="auth-container">
        <div class="grid wide">
            <div class="row">
                <!-- Left Panel - Benefits -->
                <div class="auth-left col l-6 m-6 c-6">
                    <div class="auth-left-panel">
                        <div class="auth-left-content">
                            <h2 class="auth-left-title">Truy cập các tính năng độc quyền bằng tài khoản miễn phí</h2>

                            <div class="auth-benefit">
                                <i class="fas fa-bookmark auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Lưu và sắp xếp những sản phẩm yêu thích với Bộ sưu tập</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-share-alt auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Chia sẻ Bộ sưu tập với bất kỳ ai ở bất cứ đâu</p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-download auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Dùng thử sản phẩm miễn phí và có thể mua trước khi nhận hàng
                                </p>
                            </div>

                            <div class="auth-benefit">
                                <i class="fas fa-eye auth-benefit-icon"></i>
                                <p class="auth-benefit-text">Dễ dàng theo dõi lịch sử mua hàng và duyệt xem</p>
                            </div>

                            <!-- Terms and Login Link -->
                            <p class="auth-text-small">
                                Bằng việc tạo tài khoản, tôi đồng ý với
                                <a href="#" class="auth-link">Điều khoản trang web</a>,
                                <a href="#" class="auth-link">Chính sách quyền riêng tư</a> và
                                <a href="#" class="auth-link">Điều khoản cấp phép</a> của BadmintonShop
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Registration Form -->
                <div class="col l-6 m-12 c-12">
                    <div class="auth-right-panel">
                        <div class="auth-form-container">

                            <h3 class="auth-title">Tạo tài khoản miễn phí</h3>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="auth-form-group">
                                    <input type="text" class="auth-input @error('name') error @enderror" name="name"
                                        value="{{ old('name') }}" placeholder="Họ và tên" required>
                                    @error('name')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                        name="password" id="password" placeholder="Mật khẩu" required>
                                    <button type="button" class="auth-password-toggle"
                                        onclick="togglePassword('password', this)">
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
                                        name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                                    @error('password_confirmation')
                                        <div class="auth-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Register Button -->
                                <button type="submit" class="auth-btn-primary">
                                    Đăng ký
                                </button>
                            </form>

                            <!-- Social Login -->
                            <button class="auth-btn-social">
                                <i class="fab fa-google"></i>
                                Tiếp tục bằng tài khoản Google
                            </button>
                            <button class="auth-btn-social">
                                <i class="fab fa-facebook-f"></i>
                                Tiếp tục bằng tài khoản Facebook
                            </button>

                            <p class="auth-text-center">
                                Bạn đã có tài khoản? <a href="{{ route('login') }}" class="auth-link">Đăng nhập</a>
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
