@extends('Buyer.layouts.app')

@section('content')
<style>
    /* Bố cục chính của trang chi tiết sản phẩm */
.product-detail {
    display: flex;
    justify-content: space-between;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Hình ảnh sản phẩm bên trái */
.product-images {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-images img {
    width: 100%;
    max-width: 400px;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
}

/* Thông tin sản phẩm bên phải */
.product-info {
    flex: 1;
    padding-left: 30px;
}

/* Phần thông tin về sản phẩm */
.product-info h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
}

.product-info p {
    font-size: 1rem;
    line-height: 1.6;
    color: #555;
}

.product-info .price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #e74c3c;
    margin-top: 10px;
}

.product-info .qty {
    font-size: 1rem;
    color: #888;
}

.product-info .btn {
    padding: 10px 20px;
    margin-top: 15px;
    font-size: 1rem;
    text-decoration: none;
    border-radius: 5px;
}

.product-info .btn-buy {
    background-color: #27ae60;
    color: white;
    margin-right: 10px;
}

.product-info .btn-buy:hover {
    background-color: #2ecc71;
}

.product-info .btn-cart {
    background-color: #3498db;
    color: white;
}

.product-info .btn-cart:hover {
    background-color: #2980b9;
}

/* Thông tin nhà cung cấp */
.supplier-info {
    margin-left: 100px;
    margin-top: 30px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.supplier-info h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.supplier-info p {
    font-size: 1rem;
    color: #555;
}

.supplier-info p strong {
    color: #333;
}

/* Đánh giá sản phẩm */
.product-rating {
    margin-left: 100px;
    margin-top: 30px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-rating h4 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.product-rating p {
    font-size: 1rem;
    color: #555;
}

@media (max-width: 768px) {
    .product-detail {
        flex-direction: column;
    }

    .product-info {
        padding-left: 0;
    }
}

</style>
    <div class="product-detail">
        <!-- Hình ảnh sản phẩm bên trái -->
        <div class="product-images">
            @foreach ($sanPham->hinhAnhSps as $hinhAnh)
                <img src="{{ asset($hinhAnh->hinhAnh) }}" alt="{{ $sanPham->tenSanPham }}">
                @break
            @endforeach
        </div>

        <!-- Thông tin sản phẩm bên phải -->
        <div class="product-info">
            <h1>{{ $sanPham->tenSanPham }}</h1>
            <p>{{ $sanPham->moTa }}</p>
            <p class="price"><strong>Giá: </strong>${{ number_format($sanPham->giaTien, 2) }}</p>
            <p><strong>Đơn vị tính: </strong>{{ $sanPham->donViTinh }}</p>
            <p><strong>Số lượng còn lại: </strong>{{ $sanPham->soLuongTonKho }}</p>
            <p><strong>Ngày sản xuất: </strong>{{ $sanPham->ngaySanXuat }}</p>
            <p><strong>Ngày hết hạn: </strong>{{ $sanPham->ngayHetHan }}</p>

            <!-- Nút mua ngay và thêm vào giỏ hàng -->
            <div>
                <a href="#" class="btn btn-buy">Mua ngay</a>
                <a href="#" class="btn btn-cart">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>

    <!-- Thông tin nhà cung cấp -->
    <div class="supplier-info">
        <h3>Thông tin nhà cung cấp</h3>
        <p><strong>Tên nhà cung cấp: </strong>{{ $sanPham->nhaCungCap->tenNCC }}</p>
        <p><strong>Địa chỉ: </strong>{{ $sanPham->nhaCungCap->diaChi }}</p>
        <p><strong>Số điện thoại: </strong>{{ $sanPham->nhaCungCap->sdt }}</p>
        <p><strong>Xuất xứ: </strong>{{ $sanPham->nhaCungCap->xuatXu }}</p>
    </div>

    <!-- Đánh giá sản phẩm -->
    <div class="product-rating">
        <h4>Đánh giá sản phẩm</h4>
        <p>Chưa có đánh giá nào.</p>
    </div>
@endsection
