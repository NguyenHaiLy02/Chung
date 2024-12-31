@extends('owner.layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Chi tiết yêu cầu nhập hàng: {{ $orderRequest->maYeuCau }}</h1>

    <div class="card mb-4">
        <div class="card-header">Thông tin chung</div>
        <div class="card-body">
            <p><strong>Tổng tiền:</strong> {{ number_format($orderRequest->tongTien, 0, ',', '.') }} VND</p>
            <p><strong>Trạng thái yêu cầu:</strong> {{ ucfirst($orderRequest->trangThaiYeuCau) }}</p>
            <p><strong>Trạng thái thanh toán:</strong> {{ ucfirst($orderRequest->trangThaiThanhToan) }}</p>
            <p><strong>Ngày nhận dự kiến:</strong> {{ \Carbon\Carbon::parse($orderRequest->ngayNhanDuKien)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Chi tiết sản phẩm</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng Yêu Cầu</th>
                        <th>Giá Tiền</th>
                        <th>Hình Ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderRequest->chiTietYeuCau as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->tinDangSanPham->tenSP }}</td>
                            <td>{{ $detail->soLuongYeuCau }}</td>
                            <td>{{ number_format($detail->giaTien, 0, ',', '.') }} VND</td>
                            <td>
                                @if($detail->tinDangSanPham->hinhanhtindang->isNotEmpty())
                                    <img src="{{ asset('storage/' . $detail->tinDangSanPham->hinhanhtindang->first()->hinhanh) }}" alt="Hình ảnh sản phẩm" style="width: 100px; height: 100px;">
                                @else
                                    <span>Không có hình ảnh</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nút quay lại -->
    <a href="{{ route('supplier.product_export_management.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
