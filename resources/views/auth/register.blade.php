@extends('buyer.layouts.app')
@section('title', 'DANAMART - Đăng Ký')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg" style="width: 450px;"> <!-- Độ rộng giữ nguyên như đăng nhập -->
        <div class="card-body">
            <h3 class="text-center mb-3" style="font-size: 24px;">Đăng Ký Tài Khoản</h3> <!-- Rút ngắn khoảng cách -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Trường nhập tài khoản -->
                <div class="form-group mb-2"> <!-- Rút ngắn khoảng cách -->
                    <label for="taiKhoan" class="form-label mb-1" style="font-size: 14px;">Tài khoản</label>
                    <input type="text" name="taiKhoan" id="taiKhoan" class="form-control custom-border" value="{{ old('taiKhoan') }}" required>
                    @error('taiKhoan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Trường nhập email -->
                <div class="form-group mb-2"> <!-- Rút ngắn khoảng cách -->
                    <label for="email" class="form-label mb-1" style="font-size: 14px;">Email</label>
                    <input type="email" name="email" id="email" class="form-control custom-border" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Trường nhập mật khẩu với icon nhắm/mở mắt -->
                <div class="form-group mb-2 position-relative"> <!-- Rút ngắn khoảng cách -->
                    <label for="matKhau" class="form-label mb-1" style="font-size: 14px;">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" name="matKhau" id="matKhau" class="form-control custom-border" required>
                        <button type="button" class="btn btn-outline-secondary border-0 position-absolute end-0 top-0 h-100 px-3" id="togglePassword">
                            <i class="bi bi-eye-slash" id="passwordIcon"></i>
                        </button>
                    </div>
                    @error('matKhau')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Button Đăng Ký -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                </div>
            </form>

            <!-- Liên kết Quay lại đăng nhập -->
            <p class="mt-3 text-center">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập tại đây</a>.
            </p>
            <div class="mt-3 text-center"> <!-- Rút ngắn khoảng cách -->
                <p class="mb-2">Hoặc đăng nhập bằng</p>
                <div class="d-flex justify-content-center">
                    <a href="" class="btn btn-outline-primary mx-2">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    <a href="" class="btn btn-outline-danger mx-2">
                        <i class="bi bi-google"></i> Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script để hiện/ẩn mật khẩu -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('matKhau');
        const passwordIcon = document.getElementById('passwordIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('bi-eye-slash');
            passwordIcon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('bi-eye');
            passwordIcon.classList.add('bi-eye-slash');
        }
    });
</script>
@endsection
