@extends('buyer.layouts.app') <!-- Kế thừa layout chính -->

@section('title', 'Giỏ hàng')

@section('content')
<div class="container my-4">
    <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>

    @if($cartItems->count() > 0)
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all" /></th> <!-- Checkbox chọn tất cả -->
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td> <!-- Checkbox cho từng sản phẩm -->
                                <td>{{ $item->sanPham->tenSanPham }}</td>
                                <td>
                                    @if($item->sanPham->hinhAnhSps->isNotEmpty())
                                        <img src="{{ asset($item->sanPham->hinhAnhSps->first()->hinhAnh) }}" 
                                            alt="{{ $item->sanPham->tenSanPham }}" 
                                            style="width: 50px; height: 50px;">
                                    @else
                                        <img src="{{ asset('images/default-product.png') }}" alt="Default" style="width: 50px; height: 50px;">
                                    @endif
                                </td>
                                <td>{{ number_format($item->sanPham->giaTien, 0, ',', '.') }}₫</td>
                                <td>
                                    <input type="number" name="quantity[{{ $item->id }}]" value="{{ $item->soLuong }}" min="0" class="form-control w-25 quantity-input">
                                </td>
                                <td>{{ number_format($item->soLuong * $item->sanPham->giaTien, 0, ',', '.') }}₫</td>
                                <td>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <h4>Tổng thanh toán: 
                    <strong>{{ number_format($cartItems->sum(fn($item) => $item->soLuong * $item->sanPham->giaTien), 0, ',', '.') }}₫</strong>
                </h4>                
                <a href="/checkout" class="btn btn-primary">Thanh toán</a>
                <button type="submit" class="btn btn-warning">Cập nhật giỏ hàng</button>
            </div>
        </form>
    @else
        <p class="text-center">Giỏ hàng của bạn hiện đang trống.</p>
        <div class="text-center">
            <a href="/" class="btn btn-secondary">Tiếp tục mua sắm</a>
        </div>
    @endif
</div>

@section('scripts')
<script>
    // Tự động chọn/deselect tất cả sản phẩm khi click vào checkbox chọn tất cả
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Xử lý việc tự động xóa sản phẩm khi số lượng bằng 0
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            if (parseInt(this.value) === 0) {
                this.closest('form').submit(); // Gửi form để xóa sản phẩm nếu số lượng = 0
            }
        });
    });
</script>
@endsection
@endsection
