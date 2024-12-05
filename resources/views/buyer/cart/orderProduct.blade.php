@extends('buyer.layouts.app')

@section('content')
    <div class="order-product-detail"style="margin: 20px">
        <div class="product-detail">
            <table class="scrollable-table">
                <thead>
                    <tr>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Mô Tả</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th> <!-- Added column for Total Price -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails as $order)
                        <tr>
                            <td>
                                @if ($order['hinhanh'])
                                    <img src="{{ asset($order['hinhanh']) }}" alt="{{ $order['tenSanPham'] }}" style="max-width: 150px;"/>
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image Available" style="max-width: 150px;"/>
                                @endif
                            </td>
                            <td>{{ $order['tenSanPham'] }}</td>
                            <td>{{ $order['moTa'] ?? 'Không có mô tả' }}</td> <!-- Thêm mô tả nếu có -->
                            <td>{{ number_format($order['totalPrice'] / $order['quantity'], 2) }} VND</td>
                            <td>{{ $order['quantity'] }}</td>
                            <td>{{ number_format($order['totalPrice'], 2) }} VND</td> <!-- Calculate total price -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Payment Section -->
            <form action="{{ route('order.fromCart') }}" method="POST">
                @csrf
                <!-- Lặp qua tất cả các chi tiết đơn hàng -->
                @foreach($orderDetails as $order)
                    <input type="hidden" name="orderDetails[{{ $loop->index }}][sanPhamId]" value="{{ $order['sanPhamId'] }}">
                    <input type="hidden" name="orderDetails[{{ $loop->index }}][quantity]" value="{{ $order['quantity'] }}">
                    <input type="hidden" name="orderDetails[{{ $loop->index }}][totalPrice]" value="{{ $order['totalPrice'] }}">
                @endforeach
            
                <!-- Phương thức thanh toán -->
                <div class="payment-options" style="text-align: right;">
                    <label for="paymentMethod" style="font-size: 14px; margin-bottom: 5px;">Phương thức thanh toán:</label>
                    <select name="paymentMethod" id="paymentMethod" required style="font-size: 14px; padding: 5px; width: auto; max-width: 200px;margin-right: 50px;">
                        <option value="cod">Thanh toán khi nhận hàng</option>
                        <option value="nvpay">Thanh toán NVPay</option>
                    </select>
                </div>
            
                <!-- Địa chỉ giao hàng -->
                <div>
                    <label for="address">Địa chỉ giao hàng:</label>
                    <input type="text" name="address" required placeholder="Nhập địa chỉ giao hàng" style="padding: 8px; font-size: 14px; width: 100%; margin-bottom: 10px;">
                </div>
                
                <!-- Số điện thoại -->
                <div>
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" name="phone" required placeholder="Nhập số điện thoại" style="padding: 8px; font-size: 14px; width: 100%; margin-bottom: 10px;">
                </div>
                
                <!-- Nút Đặt hàng -->
                <button type="submit" class="btn btn-buy" style="padding: 8px 16px; font-size: 14px; width: auto; max-width: 200px; display: block; margin-top: 10px; margin-left: auto;margin-right: 50px;">
                    Đặt hàng
                </button>
            </form>           
            
            
        </div>
    </div>
@endsection

<style>
    .scrollable-table {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
    }

    .scrollable-table th, .scrollable-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .scrollable-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .scrollable-table img {
        max-width: 100%;
        height: auto;
    }

    .payment-options {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .payment-options select {
        padding: 8px;
        font-size: 16px;
        width: 100%;
    }

    .btn.btn-buy {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-align: center;
        font-size: 16px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }

    .btn.btn-buy:hover {
        background-color: #218838;
    }
</style>
