@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Chi tiết nhà cung cấp</h1>

    <!-- Thông tin nhà cung cấp -->
    <div class="card mb-4">
        <div class="card-header">Thông tin chung</div>
        <div class="card-body">
            <p><strong>Tài khoản:</strong> {{ $supplier->TaiKhoan->taiKhoan ?? 'Chưa có' }}</p>
            <p><strong>Tên nhà cung cấp:</strong> {{ $supplier->tenNCC }}</p>
            <p><strong>Địa chỉ:</strong> {{ $supplier->diaChi }}</p>
            <p><strong>Số điện thoại:</strong> {{ $supplier->sdt }}</p>
            <p><strong>Xuất xứ:</strong> {{ $supplier->xuatXu }}</p>
            <p><strong>Trạng thái:</strong> {{ $supplier->pheDuyet ? 'Đã duyệt' : 'Chưa duyệt' }}</p>
        </div>
    </div>

    <!-- Danh sách chứng nhận -->
   <div class="card mb-4">
    <div class="card-header">Chứng nhận</div>
    <div class="card-body">
        @if($supplier->chungNhans->count() > 0)
            <div class="row">
                @foreach($supplier->chungNhans as $chungNhan)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $chungNhan->hinhanh) }}" alt="Chứng nhận" class="img-fluid rounded">
                    </div>
                @endforeach
            </div>
        @else
            <p>Không có chứng nhận</p>
        @endif
    </div>
</div>

    <!-- Nút quay lại -->
    <a href="{{ route('owner.supplier_management.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
