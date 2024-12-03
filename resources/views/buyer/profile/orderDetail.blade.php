@extends('buyer.profile.index')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content1')
<div class="order-detail-container">
    <h1>Chi Tiết Đơn Hàng: {{ $order->maDonHang }}</h1>
    <p><strong>Ngày Đặt Hàng:</strong> {{ $order->ngayDatHang }}</p>
    <p><strong>Tổng Tiền:</strong> {{ number_format($order->tongTien, 0, ',', '.') }} VND</p>
    <p><strong>Trạng Thái:</strong> {{ $order->trangThaiDonHang }}</p>
    <h2>Danh Sách Sản Phẩm:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->chiTietDonHangs as $detail)
                <tr>
                    <td>{{ $detail->sanPham->tenSanPham ?? 'Sản phẩm không tồn tại' }}</td>
                    <td>{{ $detail->soLuong }}</td>
                    <td>{{ number_format($detail->donGia, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($detail->soLuong * $detail->donGia, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
