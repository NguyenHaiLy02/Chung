@extends('buyer.layouts.app')

@section('content')
    <div class="order-product-detail" style="margin: 20px">
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
                    <tr>
                        <td>
                            @if ($sanPham->hinhAnhSps->isNotEmpty())
                                <img src="{{ asset('storage/' . $sanPham->hinhAnhSps->first()->hinhAnh) }}"
                                    alt="{{ $sanPham->tenSanPham }}" style="max-width: 150px;" />
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image Available"
                                    style="max-width: 150px;" />
                            @endif


                        </td>
                        <td>{{ $sanPham->tenSanPham }}</td>
                        <td>{{ $sanPham->moTa }}</td>
                        <td>{{ number_format($sanPham->giaTien, 2) }} VND</td>
                        <td>{{ $quantity }}</td>
                        <td>{{ number_format($sanPham->giaTien * $quantity, 2) }} VND</td> <!-- Calculate total price -->
                    </tr>
                </tbody>
            </table>

            <!-- Payment Section -->
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="sanPhamId" value="{{ $sanPham->maSanPham }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">
                <input type="hidden" name="totalPrice" value="{{ $sanPham->giaTien * $quantity }}">

                <div class="payment-options" style="text-align: right;">
                    <label for="paymentMethod" style="font-size: 14px; margin-bottom: 5px;">Phương thức thanh toán:</label>
                    <select name="paymentMethod" id="paymentMethod" required
                        style="font-size: 14px; padding: 5px; width: auto; max-width: 200px;margin-right: 50px;">
                        <option value="cod">Thanh toán khi nhận hàng</option>
                        <option value="nvpay">Thanh toán VNPay</option>
                    </select>
                </div>

                <!-- Delivery Address and Phone Number (optional but recommended for COD) -->
                <div>
                    <label for="address" style="font-size: 14px; font-weight: bold; margin-bottom: 8px; display: block;">Địa chỉ giao hàng:</label>
                    <input type="text" name="address" required placeholder="Nhập địa chỉ giao hàng"
                        style="padding: 10px; font-size: 14px; width: 50%; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; margin-bottom: 15px;">
                </div>
                
                <div>
                    <label for="phone" style="font-size: 14px; font-weight: bold; margin-bottom: 8px; display: block;">Số điện thoại:</label>
                    <input type="text" name="phone" required placeholder="Nhập số điện thoại"
                        style="padding: 10px; font-size: 14px; width: 50%; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; margin-bottom: 15px;">
                </div>                

                <button type="submit" class="btn btn-buy"
                    style="padding: 8px 16px; font-size: 14px; width: auto; max-width: 200px; display: block; margin-top: 10px; margin-left: auto;margin-right: 50px;">
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

    .scrollable-table th,
    .scrollable-table td {
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
