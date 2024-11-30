@extends('buyer.layouts.app')
@section('title', 'DANAMART')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg" style="width: 450px;"> <!-- Tăng độ rộng trở lại -->
        <div class="card-body">
            <h3 class="text-center mb-3" style="font-size: 24px;">Đăng Nhập</h3> <!-- Rút ngắn khoảng cách -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Trường nhập tài khoản/email -->
                <div class="form-group mb-2"> <!-- Rút ngắn khoảng cách -->
                    <label for="login" class="form-label mb-1" style="font-size: 14px;">Tài khoản hoặc Email</label>
                    <input type="text" name="login" id="login" class="form-control custom-border" value="{{ old('login') }}" required>
                    @error('login')
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

                <!-- Liên kết Quên mật khẩu -->
                <div class="mb-3 text-end">
                    <a href="" class="text-decoration-none">Quên mật khẩu? Lấy lại tại đây</a>
                </div>

                <!-- Button Đăng Nhập -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                </div>
            </form>

            <!-- Hoặc Đăng nhập bằng -->
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

            <!-- Liên kết Đăng ký -->
            <p class="mt-3 text-center">
                Nếu chưa có tài khoản, vui lòng <a href="{{ route('register') }}">đăng ký tại đây</a>.
            </p>
        </div>
    </div>
</div>

@endsection
