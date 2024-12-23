@extends('owner.layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
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
                                        <a href="{{ route('owner.order.detail', $order->maDonHang) }}">Xem chi tiết</a>
                                    </td>
                                    <td>
                                        @php
                                            $user = \App\Models\TbTaiKhoan::where(
                                                'taiKhoan',
                                                session('username'),
                                            )->first();
                                            $quyen = $user->quyen;

                                            // Khởi tạo mảng hành động rỗng
                                            $actions = [];

                                            // Kiểm tra quyền của người dùng và thêm hành động vào mảng
                                            if ($quyen == 'nhanvien' || $quyen == 'chucuahang') {
                                                $actions = [
                                                    'Đang xử lý' => [
                                                        'onclick' => 'confirmOrder(this)',
                                                        'label' => 'Xác nhận đơn hàng',
                                                    ],
                                                    'Đã duyệt' => [
                                                        'onclick' => 'confirmOrder3(this)',
                                                        'label' => 'Chuẩn bị hàng',
                                                    ],
                                                    'Chuẩn bị hàng' => [
                                                        'onclick' => 'confirmOrder5(this)',
                                                        'label' => 'Giao cho đơn vị vận chuyển',
                                                    ],
                                                ];
                                            } else {
                                                $actions = [
                                                    'Chờ vận chuyển' => [
                                                        'onclick' => 'confirmOrder4(this)',
                                                        'label' => 'Nhận giao hàng',
                                                    ],
                                                    'Đang vận chuyển' => [
                                                        'onclick' => 'confirmOrder2(this)',
                                                        'label' => 'Xác nhận giao hàng',
                                                    ],
                                                ];
                                            }
                                        @endphp


                                        @if (isset($actions[$order->trangThaiDonHang]))
                                            <button class="btn-confirm" data-ma-don-hang="{{ $order->maDonHang }}"
                                                onclick="{{ $actions[$order->trangThaiDonHang]['onclick'] }}">
                                                {{ $actions[$order->trangThaiDonHang]['label'] }}
                                            </button>
                                        @else
                                            {{ $order->trangThaiDonHang }}
                                        @endif
                                    </td>
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
            document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');
            const activeContent = document.getElementById('tab-' + status);
            if (activeContent) activeContent.style.display = 'block';

            document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));
            const activeButton = document.querySelector(`.tab-button[onclick="showTab('${status}')"]`);
            if (activeButton) activeButton.classList.add('active');
        }

        // Hàm xử lý cập nhật trạng thái chung
        function updateOrderStatus(button, newStatus) {
            const maDonHang = button.getAttribute('data-ma-don-hang');
            if (!maDonHang) return;

            fetch(`/orders/confirm/${maDonHang}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status: newStatus
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

        // Các hàm gọi hàm chung với trạng thái tương ứng
        function confirmOrder(button) {
            updateOrderStatus(button, 'Đã duyệt');
        }

        function confirmOrder2(button) {
            updateOrderStatus(button, 'Đã giao hàng');
        }

        function confirmOrder3(button) {
            updateOrderStatus(button, 'Chuẩn bị hàng');
        }

        function confirmOrder4(button) {
            updateOrderStatus(button, 'Đang vận chuyển');
        }

        function confirmOrder5(button) {
            updateOrderStatus(button, 'Chờ vận chuyển');
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
