@extends('buyer.layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="cart" style="margin: 20px">
        <form method="POST" action="{{ route('cart.placeOrder') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"> Chọn tất cả</th>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="selectedItems[]" value="{{ $item->id }}"
                                    class="item-checkbox">
                            </td>
                            <td>{{ $item->sanPham->tenSanPham }}</td>
                            <td>
                                <img src="{{ $item->sanPham->hinhAnhSps->first()->hinhAnh }}"
                                    alt="{{ $item->sanPham->tenSanPham }}" width="100">
                            </td>
                            <td>{{ number_format($item->sanPham->giaTien, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <div class="quantity-control" style="display: flex; align-items: center; gap: 5px;">
                                    <button type="button" class="btn btn-secondary decrease-quantity"
                                        data-id="{{ $item->id }}" style="padding: 5px 10px; font-size: 14px;">-</button>
                                    <input type="number" name="soLuong" value="{{ $item->soLuong }}"
                                        class="form-control quantity-input" data-id="{{ $item->id }}" min="1"
                                        style="width: 50px; text-align: center; font-size: 14px;">
                                    <button type="button" class="btn btn-secondary increase-quantity"
                                        data-id="{{ $item->id }}" style="padding: 5px 10px; font-size: 14px;">+</button>
                                </div>
                            </td>
                            <td>{{ number_format($item->sanPham->giaTien * $item->soLuong, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <button type="button" class="btn btn-danger delete-item"
                                    data-id="{{ $item->id }}">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total" style="text-align: right; margin: 20px;">
                <p>Tổng tiền:
                    <span id="totalAmount">
                        @if (session('total'))
                            {{ number_format(session('total'), 0, ',', '.') }} VNĐ
                        @else
                            0 VNĐ
                        @endif
                    </span>
                </p>
                <button type="submit" class="btn btn-primary">Đặt hàng</button>
            </div>
        </form>
    </div>

    <script>
        function updateTotalPrice() {
        let total = 0;
        document.querySelectorAll('.item-checkbox:checked').forEach(function(checkbox) {
            const row = checkbox.closest('tr');
            const totalPrice = parseInt(
                row.querySelector('td:nth-child(6)').innerText.replace(' VNĐ', '').replaceAll('.', ''), // Cột 6 là tổng cộng
                10
            );
            total += totalPrice;
        });
        document.getElementById('totalAmount').innerText = total.toLocaleString() + ' VNĐ';
    }

    // Event listener for checkbox selection
    document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    // Event listener for "Select All" checkbox
    document.getElementById('selectAll').addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
        updateTotalPrice();
    });

    // AJAX to update quantity
    function updateQuantity(id, quantity) {
        fetch(`/cart/update-quantity/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ soLuong: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                const row = document.querySelector(`.quantity-input[data-id="${id}"]`).closest('tr');
                row.querySelector('td:nth-child(6)').innerText = data.totalPrice; // Cột tổng cộng
                updateTotalPrice(); // Tính lại tổng giá trị giỏ hàng
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Event listener for quantity buttons and input
    document.querySelectorAll('.decrease-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
            const newValue = Math.max(1, parseInt(input.value) - 1);
            input.value = newValue;
            updateQuantity(id, newValue);
        });
    });

    document.querySelectorAll('.increase-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
            const newValue = parseInt(input.value) + 1;
            input.value = newValue;
            updateQuantity(id, newValue);
        });
    });

    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
            const id = this.dataset.id;
            const newValue = Math.max(1, parseInt(this.value));
            this.value = newValue;
            updateQuantity(id, newValue);
        });
    });

        // Sự kiện cho nút xóa sản phẩm
        document.querySelectorAll('.delete-item').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;

                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    fetch(`/cart/remove-item/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Xóa dòng sản phẩm trong giỏ hàng
                                this.closest('tr').remove();
                                updateTotalPrice(); // Cập nhật tổng tiền sau khi xóa
                            } else {
                                alert(data.message); // Hiển thị lỗi nếu có
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
@endsection
