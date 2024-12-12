@extends('owner.layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
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

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Nút xác nhận nhận tất cả --}}
        @if ($order->trangThaiDonHang == 'Đang xử lý')
            <div style="margin-top: 20px; text-align: right;">
                <button class="btn btn-primary" data-ma-don-hang="{{ $order->maDonHang }}" onclick="confirmOrder(this)">
                    Xác nhận đơn hàng
                </button>
            </div>
        @endif
        @if ($order->trangThaiDonHang == 'Đang vận chuyển')
            <div style="margin-top: 20px; text-align: right;">
                <button class="btn btn-primary" data-ma-don-hang="{{ $order->maDonHang }}" onclick="confirmOrder2(this)">
                    Xác nhận giao hàng
                </button>
            </div>
        @endif
            <div style="margin-top: 20px; text-align: center;">
                <a href="{{ route('owner.orders') }}" class="btn btn-primary"
                    style="padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 5px; text-decoration: none;">Trở
                    lại</a>
            </div>
    </div>
@endsection
<script>
    function confirmOrder(button) {
        const maDonHang = button.getAttribute('data-ma-don-hang');

        if (!maDonHang) return;

        // Gửi yêu cầu cập nhật trạng thái
        fetch(`/owner/orders/confirm/${maDonHang}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: 'Đang vận chuyển'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cập nhật trạng thái thành công!');
                    location.reload(); // Tải lại trang sau khi cập nhật thành công
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Không thể kết nối, vui lòng thử lại sau.');
            });
    }
    function confirmOrder2(button) {
            const maDonHang = button.getAttribute('data-ma-don-hang');

            if (!maDonHang) return;

            // Gửi yêu cầu cập nhật trạng thái
            fetch(`/orders/confirm/${maDonHang}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status: 'Đã giao hàng'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cập nhật trạng thái thành công!');
                        location.reload(); // Tải lại trang sau khi cập nhật thành công
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Không thể kết nối, vui lòng thử lại sau.');
                });
        }
</script>
