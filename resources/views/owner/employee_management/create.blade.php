@extends('owner.layouts.app')
@section('title', 'Trang quản trị')
@section('content')
    <div class="container">
        <h2>Thêm mới nhân viên</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('owner.employee_management.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="taiKhoan" class="form-label">Tài khoản</label>
                <input type="text" name="taiKhoan" id="taiKhoan" class="form-control" value="{{ old('taiKhoan') }}"
                    required>
                @error('taiKhoan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="matKhau" class="form-label">Mật khẩu</label>
                <input type="password" name="matKhau" id="matKhau" class="form-control" required>
                @error('matKhau')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quyen" class="form-label">Quyền</label>
                <select name="quyen" id="quyen" class="form-control" required>
                    <option value="nhanvien" {{ old('quyen') == 'nhanvien' ? 'selected' : '' }}>nhanvien</option>
                    <option value="nhanviengiaohang" {{ old('quyen') == 'quanly' ? 'selected' : '' }}>nhanviengiaohang
                    </option>            
                </select>
                @error('quyen')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ tên</label>
                <input type="text" name="hoTen" id="hoTen" class="form-control" value="{{ old('hoTen') }}"
                    required>
                @error('hoTen')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="chucVu" class="form-label">Chức vụ</label>
                <select name="chucVu" id="chucVu" class="form-control" required>
                    <option value="">-- Chọn chức vụ --</option>
                    <option value="Nhân viên bán hàng" {{ old('chucVu') == 'Nhân viên bán hàng' ? 'selected' : '' }}>Nhân viên bán hàng</option>
                    <option value="Nhân viên giao hàng" {{ old('chucVu') == 'Nhân viên giao hàng' ? 'selected' : '' }}>Nhân viên giao hàng</option>
                </select>
                @error('chucVu')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>        

            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày sinh</label>
                <input type="date" name="ngaySinh" id="ngaySinh" class="form-control" value="{{ old('ngaySinh') }}"
                    required>
                @error('ngaySinh')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cccd" class="form-label">CCCD</label>
                <input type="text" name="cccd" id="cccd" class="form-control" value="{{ old('cccd') }}"
                    required>
                @error('cccd')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sdt" class="form-label">Số điện thoại</label>
                <input type="text" name="sdt" id="sdt" class="form-control" value="{{ old('sdt') }}"
                    required>
                @error('sdt')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="diachi" class="form-label">Địa chỉ</label>
                <input type="text" name="diachi" id="diachi" class="form-control" value="{{ old('diachi') }}"
                    required>
                @error('diachi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div>
@endsection
