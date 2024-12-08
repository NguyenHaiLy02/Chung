@extends('buyer.profile.index')
@section('title', 'Đơn Mua')
@section('content1')
    <div class="orders-container">
        <h1>Danh Sách Đơn Mua</h1>

        <!-- Tabs trạng thái -->
        <div class="tabs">
            @foreach ($statuses as $status)
                <button class="tab-button" onclick="showTab('{{ $status }}')">
                    {{ $status }}
                </button>
            @endforeach
        </div>

        <!-- Nội dung từng trạng thái -->
        @foreach ($groupedOrders as $status => $orders)
            <div class="tab-content" id="tab-{{ $status }}" style="display: none;">
                <h2>{{ $status }}</h2>
                @if ($orders->isEmpty())
                    <p>Không có đơn hàng nào ở trạng thái này.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã Đơn Hàng</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>DH {{ $order->maDonHang }} ({{ $order->trangThaiDonHang }})</td>
                                    <td>{{ $order->ngayDatHang }}</td>
                                    <td>{{ number_format($order->tongTien, 0, ',', '.') }} VND</td>
                                    <td>
                                        <a href="{{ route('order.detail', $order->maDonHang) }}">Xem chi tiết</a>
                                    </td>
                                    @if ($order->trangThaiDonHang == 'Đã giao hàng')
                                        <td>
                                            <button class="btn-confirm" data-ma-don-hang="{{ $order->maDonHang }}" 
                                                onclick="confirmOrder(this)">
                                                Nhận hàng
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach
    </div>

    <script>
        // Hiển thị tab đầu tiên khi tải trang
        document.addEventListener('DOMContentLoaded', function() {
            const firstTab = document.querySelector('.tab-button');
            if (firstTab) {
                firstTab.click();
            }
        });

        // Hàm chuyển đổi giữa các tab
        function showTab(status) {
            // Ẩn tất cả nội dung
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => {
                content.style.display = 'none';
            });

            // Hiển thị nội dung của tab được chọn
            const activeContent = document.getElementById('tab-' + status);
            if (activeContent) {
                activeContent.style.display = 'block';
            }

            // Xóa trạng thái "active" khỏi tất cả nút
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Thêm trạng thái "active" cho nút được chọn
            const activeButton = document.querySelector(`.tab-button[onclick="showTab('${status}')"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
        }
        function confirmOrder(button) {

        const maDonHang = button.getAttribute('data-ma-don-hang');

        if (!maDonHang) return;

        // Gửi yêu cầu cập nhật trạng thái
        fetch(`/orders/confirm/${maDonHang}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: 'Đã nhận' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cập nhật trạng thái thành công!');
                // Thay đổi trạng thái trực tiếp trên giao diện
                button.disabled = true;
                button.textContent = 'Đã nhận';
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


    <style>
        .tabs {
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            cursor: pointer;
            margin-right: 5px;
        }

        .tab-button.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .tab-content {
            margin-top: 20px;
        }

        /* CSS cho nút xác nhận */
        .btn-confirm {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-confirm:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-confirm:active {
            background-color: #1e7e34;
            transform: scale(0.95);
        }

        .btn-confirm:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
            transform: none;
        }
    </style>
@endsection
