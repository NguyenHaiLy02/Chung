@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Chỉnh sửa nhân viên</h2>

    <form action="{{ route('owner.employee_management.update', $employee->maNhanVien) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="taiKhoan" class="form-label">Tài khoản</label>
            <input type="text" name="taiKhoan" id="taiKhoan" class="form-control" value="{{ $employee->taiKhoan }}" readonly required>
        </div>

        <div class="mb-3">
            <label for="matKhau" class="form-label">Mật khẩu</label>
            <input type="password" name="matKhau" id="matKhau" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $employee->TaiKhoan->email }}" required>
        </div>

        <div class="mb-3">
            <label for="hoTen" class="form-label">Họ tên</label>
            <input type="text" name="hoTen" id="hoTen" class="form-control" value="{{ $employee->hoTen }}" required>
        </div>

        <div class="mb-3">
            <label for="chucVu" class="form-label">Chức vụ</label>
            <input type="text" name="chucVu" id="chucVu" class="form-control" value="{{ $employee->chucVu }}" required>
        </div>

        <div class="mb-3">
            <label for="ngaySinh" class="form-label">Ngày sinh</label>
            <input type="date" name="ngaySinh" id="ngaySinh" class="form-control" value="{{ $employee->ngaySinh }}">
        </div>

        <div class="mb-3">
            <label for="cccd" class="form-label">CCCD</label>
            <input type="text" name="cccd" id="cccd" class="form-control" value="{{ $employee->cccd }}">
        </div>

        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại</label>
            <input type="text" name="sdt" id="sdt" class="form-control" value="{{ $employee->sdt }}">
        </div>

        <div class="mb-3">
            <label for="diaChi" class="form-label">Địa chỉ</label>
            <textarea name="diachi" id="diachi" class="form-control">{{ $employee->diachi ?? old('diachi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
