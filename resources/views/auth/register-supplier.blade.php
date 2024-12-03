@extends('buyer.layouts.app')
@section('title', 'DANAMART - Đăng Ký Nhà Cung Cấp')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg" style="width: 600px;">
        <div class="card-body">
            <h3 class="text-center mb-3" style="font-size: 24px;">Đăng Ký Nhà Cung Cấp</h3>
            
            <!-- Hiển thị thông báo thành công -->
            @if (session('success'))
                <p class="success-message text-center mb-3" style="color: green;">{{ session('success') }}</p>
            @endif

            <!-- Form đăng ký nhà cung cấp -->
            <form action="{{ route('supplier.register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Bước 1: Thông tin tài khoản -->
                <div class="step step-1">
                    <div class="form-group mb-3">
                        <label for="taiKhoan" class="form-label mb-1" style="font-size: 14px;">Tên đăng nhập</label>
                        <input type="text" name="taiKhoan" id="taiKhoan" class="form-control custom-border" placeholder="Nhập tên đăng nhập" value="{{ old('taiKhoan') }}" required>
                        @error('taiKhoan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label mb-1" style="font-size: 14px;">Email</label>
                        <input type="email" name="email" id="email" class="form-control custom-border" placeholder="Nhập địa chỉ email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <label for="matKhau" class="form-label mb-1" style="font-size: 14px;">Mật khẩu</label>
                        <div class="input-group">
                            <input type="password" name="matKhau" id="matKhau" class="form-control custom-border" placeholder="Nhập mật khẩu" required>
                            <button type="button" class="btn btn-outline-secondary border-0 position-absolute end-0 top-0 h-100 px-3" id="togglePassword">
                                <i class="bi bi-eye-slash" id="passwordIcon"></i>
                            </button>
                        </div>
                        @error('matKhau')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Chuyển qua bước 2 -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary w-100" id="nextStepBtn">Tiếp Tục</button>
                    </div>
                </div>

                <!-- Bước 2: Thông tin nhà cung cấp -->
                <div class="step step-2" style="display: none;">
                    <div class="row">
                        <!-- Cột 1 -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="tenNCC" class="form-label mb-1" style="font-size: 14px;">Tên nhà cung cấp</label>
                                <input type="text" name="tenNCC" id="tenNCC" class="form-control custom-border" placeholder="Nhập tên nhà cung cấp" value="{{ old('tenNCC') }}" required>
                                @error('tenNCC')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="diaChi" class="form-label mb-1" style="font-size: 14px;">Địa chỉ</label>
                                <input type="text" name="diaChi" id="diaChi" class="form-control custom-border" placeholder="Nhập địa chỉ" value="{{ old('diaChi') }}" required>
                                @error('diaChi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="sdt" class="form-label mb-1" style="font-size: 14px;">Số điện thoại</label>
                                <input type="text" name="sdt" id="sdt" class="form-control custom-border" placeholder="Nhập số điện thoại" value="{{ old('sdt') }}" required>
                                @error('sdt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Cột 2 -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label for="xuatXu" class="form-label mb-1" style="font-size: 14px;">Xuất xứ</label>
                                <input type="text" name="xuatXu" id="xuatXu" class="form-control custom-border" placeholder="Nhập xuất xứ" value="{{ old('xuatXu') }}" required>
                                @error('xuatXu')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label for="maDanhMuc" class="form-label mb-1" style="font-size: 14px;">Danh mục sản phẩm</label>
                                <div class="dropdown">
                                    <select name="maDanhMuc" id="maDanhMuc" class="form-control custom-border" required>
                                        @foreach ($danhmucs as $danhmuc)
                                            <option value="{{ $danhmuc->maDanhMuc }}" {{ old('maDanhMuc') == $danhmuc->maDanhMuc ? 'selected' : '' }}>{{ $danhmuc->tenDanhMuc }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down position-absolute end-0 top-50 translate-middle-y me-3" style="font-size: 18px;"></i>
                                </div>
                                @error('maDanhMuc')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="hinhanh" class="form-label mb-1" style="font-size: 14px;">Hình ảnh chứng nhận</label>
                                <input type="file" name="hinhanh[]" id="hinhanh" class="form-control custom-border" multiple>
                                @error('hinhanh')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script để điều hướng giữa các bước -->
<script>
    document.getElementById('nextStepBtn').addEventListener('click', function () {
        document.querySelector('.step-1').style.display = 'none';
        document.querySelector('.step-2').style.display = 'block';
    });

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
