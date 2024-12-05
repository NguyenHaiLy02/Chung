@extends('buyer.layouts.app')

@section('content')
<div class="order-success" style="text-align: center; padding: 20px;">
    <h1>Đặt hàng thành công!</h1>
    <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>

    <h3>Thông tin đơn hàng:</h3>
    <p><strong>Mã đơn hàng:</strong> {{ $order->maDonHang }}</p>    
    <p><strong>Tổng tiền:</strong> {{ number_format($order->tongTien, 0, ',', '.') }} VNĐ</p>

    <h4>Chi tiết sản phẩm:</h4>
    <table style="width: 100%; margin-bottom: 20px;">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->sanPham->tenSanPham }}</td>
                    <td>{{ $detail->soLuong }}</td>
                    <td>{{ number_format($detail->donGia, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($detail->soLuong * $detail->donGia, 0, ',', '.') }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="#" style="text-decoration: none; color: white; background-color: #3498db; padding: 10px 20px; border-radius: 5px;">Quay lại trang chủ</a>
</div>
@endsection
