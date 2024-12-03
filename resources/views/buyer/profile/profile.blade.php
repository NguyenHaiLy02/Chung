@extends('buyer.profile.index')
@section('content1')
    <div class="profile-container">
        <h4>Quản lý thông tin hồ sơ để bảo mật tài khoản</h4>
        <hr>
        <div class="profile-details">
            <p><strong>Tài khoản:</strong> {{ $user->taiKhoan }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <hr>
            <p><strong>Tên:</strong> {{ $user->khachHang->tenTaiKhoan }}</p>
            <p><strong>Số điện thoại:</strong> {{ $user->khachHang->sdt }}</p>
            <p><strong>Địa chỉ:</strong> {{ $user->khachHang->diaChi }}</p>
            <p>
                <strong>Ảnh đại diện:</strong><br>
                <img src="{{ asset('storage/' . $user->khachHang->anhDaiDien) }}" alt="Ảnh đại diện"
                style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
            </p>
            <a href="{{ route('profile.edit', ['id' => $user->khachHang->maKhachHang]) }}" class="btn btn-primary">
                Chỉnh Sửa Thông Tin
            </a>
        </div>
    </div>
@endsection
