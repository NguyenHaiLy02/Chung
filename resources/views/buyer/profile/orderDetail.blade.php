@extends('buyer.profile.index')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content1')
    @if (session('success'))
        <div style="color: green; margin-top: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="order-detail-container"
        style="padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #333;">Chi Tiết Đơn Hàng: {{ $order->maDonHang }}</h1>

        <div class="order-summary" style="margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 15px;">
            <p><strong>Ngày Đặt Hàng:</strong> {{ \Carbon\Carbon::parse($order->ngayDatHang)->format('d/m/Y') }}</p>
            <p><strong>Tổng Tiền:</strong> {{ number_format($order->tongTien, 0, ',', '.') }} VND</p>
            <p><strong>Trạng Thái:</strong> {{ $order->trangThaiDonHang }}</p>
            <p><strong>Trạng Thái Thanh Toán:</strong> {{ $order->trangThaiThanhToan }}</p>
        </div>

        <h2 style="font-size: 22px; margin-bottom: 15px; color: #333;">Danh Sách Sản Phẩm:</h2>
        <table class="table table-striped"
            style="width: 100%; border-collapse: collapse; background-color: #fff; border-radius: 8px;">
            <thead style="background-color: #f1f1f1;">
                <tr>
                    <th style="padding: 10px; text-align: left; font-weight: bold;">Hình Ảnh</th>
                    <th style="padding: 10px; text-align: left; font-weight: bold;">Tên Sản Phẩm</th>
                    <th style="padding: 10px; text-align: left; font-weight: bold;">Số Lượng</th>
                    <th style="padding: 10px; text-align: left; font-weight: bold;">Đơn Giá (VND)</th>
                    <th style="padding: 10px; text-align: left; font-weight: bold;">Tổng Giá (VND)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $detail->hinhAnh) }}" alt="{{ $detail->tenSanPham }}"
                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">

                        </td>
                        <td>{{ $detail->tenSanPham }}</td>
                        <td>{{ $detail->soLuong }}</td>
                        <td>{{ number_format($detail->donGia, 0, ',', '.') }}</td>
                        <td>{{ number_format($detail->soLuong * $detail->donGia, 0, ',', '.') }}</td>
                        @if ($order->trangThaiDonHang == 'Đã nhận')
                            {{-- Kiểm tra trạng thái đã đánh giá --}}
                            @if (!$detail->daDanhGia)
                                <td>
                                    <form action="{{ route('danhgia.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="maChiTietDonHang"
                                            value="{{ $detail->maChiTietDonHang }}">
                                        <div>
                                            <select name="soLuongSao" required>
                                                <option value="1">1 Sao</option>
                                                <option value="2">2 Sao</option>
                                                <option value="3">3 Sao</option>
                                                <option value="4">4 Sao</option>
                                                <option value="5">5 Sao</option>
                                            </select>
                                        </div>
                                        <textarea name="noiDung" placeholder="Viết đánh giá..." required></textarea>
                                        <button type="submit" class="btn btn-success">Gửi Đánh Giá</button>
                                    </form>
                                </td>
                            @else
                                <td>Đã đánh giá</td>
                            @endif
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Nút xác nhận nhận tất cả --}}
        @if ($order->trangThaiDonHang == 'Đã giao hàng')
            <div style="margin-top: 20px; text-align: right;">
                <form action="{{ route('order.confirmAll', $order->maDonHang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary"
                        style="padding: 10px 20px; background-color: #28a745; color: #fff; border-radius: 5px; text-decoration: none;">Xác
                        Nhận Nhận Tất Cả</button>
                </form>
            </div>
        @endif

        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('orders') }}" class="btn btn-primary"
                style="padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 5px; text-decoration: none;">Trở
                lại</a>
        </div>
    </div>
@endsection
