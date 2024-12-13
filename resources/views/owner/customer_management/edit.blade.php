@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa tài khoản khách hàng</h1>
    <form action="{{ route('owner.customer_management.update', $account->taiKhoan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tenTaiKhoan" class="form-label">Tên khách hàng</label>
            <input type="text" name="tenTaiKhoan" id="tenTaiKhoan" class="form-control" value="{{ $account->khachHang->tenTaiKhoan ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $account->email }}" required>
        </div>

        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại</label>
            <input type="text" name="sdt" id="sdt" class="form-control" value="{{ $account->khachHang->sdt ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="diaChi" class="form-label">Địa chỉ</label>
            <textarea name="diaChi" id="diaChi" class="form-control" rows="3">{{ $account->khachHang->diaChi ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('owner.customer_management.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
