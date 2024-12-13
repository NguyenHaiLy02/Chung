@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">{{ isset($employee) ? 'Chỉnh sửa' : 'Thêm mới' }} nhân viên</h2>

    <form action="{{ isset($employee) ? route('owner.employee_management.update', $employee->maNhanVien) : route('owner.employee_management.store') }}" method="POST">
        @csrf
        @if(isset($employee)) @method('PUT') @endif

        <div class="mb-3">
            <label for="taiKhoan" class="form-label">Tài khoản</label>
            <input type="text" name="taiKhoan" id="taiKhoan" class="form-control" value="{{ $employee->taiKhoan ?? old('taiKhoan') }}" {{ isset($employee) ? 'readonly' : '' }} required>
        </div>

        <div class="mb-3">
            <label for="matKhau" class="form-label">Mật khẩu</label>
            <input type="password" name="matKhau" id="matKhau" class="form-control" {{ isset($employee) ? '' : 'required' }}>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $employee->taiKhoan->email ?? old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="hoTen" class="form-label">Họ tên</label>
            <input type="text" name="hoTen" id="hoTen" class="form-control" value="{{ $employee->hoTen ?? old('hoTen') }}" required>
        </div>

        <div class="mb-3">
            <label for="chucVu" class="form-label">Chức vụ</label>
            <input type="text" name="chucVu" id="chucVu" class="form-control" value="{{ $employee->chucVu ?? old('chucVu') }}" required>
        </div>

        <div class="mb-3">
            <label for="ngaySinh" class="form-label">Ngày sinh</label>
            <input type="date" name="ngaySinh" id="ngaySinh" class="form-control" value="{{ $employee->ngaySinh ?? old('ngaySinh') }}">
        </div>

        <div class="mb-3">
            <label for="cccd" class="form-label">CCCD</label>
            <input type="text" name="cccd" id="cccd" class="form-control" value="{{ $employee->cccd ?? old('cccd') }}">
        </div>

        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại</label>
            <input type="text" name="sdt" id="sdt" class="form-control" value="{{ $employee->sdt ?? old('sdt') }}">
        </div>

        <div class="mb-3">
            <label for="diaChi" class="form-label">Địa chỉ</label>
            <textarea name="diaChi" id="diaChi" class="form-control">{{ $employee->diachi ?? old('diachi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($employee) ? 'Cập nhật' : 'Thêm mới' }}</button>
    </form>
</div>
@endsection
