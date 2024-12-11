@extends('Buyer.layouts.app')

@section('content')
    <style>
        .product-detail {
            display: flex;
            justify-content: space-between;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

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

        .product-info {
            flex: 1;
            padding-left: 30px;
        }

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
            background-color: #7bc548;
            color: white;
        }

        .product-info .btn-cart:hover {
            background-color: #7bc548;
        }

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

    @if (session('success'))
        <div style="margin-top: 10px; color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-detail">
        <div class="product-images">
            @foreach ($sanPham->hinhAnhSps as $hinhAnh)
                <img src="{{ asset('storage/' . $hinhAnh->hinhAnh) }}" alt="{{ $sanPham->tenSanPham }}">
            @break
        @endforeach
    </div>

    <div class="product-info">
        <h1>{{ $sanPham->tenSanPham }}</h1>
        <p>{{ $sanPham->moTa }}</p>
        <p class="price"><strong>Giá: </strong>${{ number_format($sanPham->giaTien, 2) }}</p>
        <div style="display: flex">
            <div>
                <p><strong>Đơn vị tính: </strong>{{ $sanPham->donViTinh }}</p>
                <p><strong>Số lượng còn lại: </strong>{{ $sanPham->soLuongTonKho }}</p>
            </div>
            <div style="margin-left: 50px">
                <p><strong>Ngày sản xuất: </strong>{{ $sanPham->ngaySanXuat }}</p>
                <p><strong>Ngày hết hạn: </strong>{{ $sanPham->ngayHetHan }}</p>
            </div>
        </div>

        <div>
            <label for="quantity" style="font-weight: bold;">Số lượng:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="{{ $sanPham->soLuongTonKho }}"
                value="{{ old('quantity', 1) }}"
                style="width: 60px; margin-left: 10px; padding: 5px; text-align: center;">
        </div>

        <div style="display: flex">
            <form action="{{ route('order.create', ['sanPhamId' => $sanPham->maSanPham]) }}" method="GET">
                @csrf
                <input type="hidden" name="quantity" id="hiddenQuantityBuy" value="{{ old('quantity', 1) }}">
                <button type="submit" class="btn btn-buy">Mua ngay</button>
            </form>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="maSanPham" value="{{ $sanPham->maSanPham }}">
                <input type="hidden" name="quantity" id="hiddenQuantityCart" value="{{ old('quantity', 1) }}">
                <button type="submit" class="btn btn-cart">Thêm vào giỏ hàng</button>
            </form>
        </div>

        <script>
            // Update the hidden quantity value when the quantity input changes for both buttons
            document.getElementById('quantity').addEventListener('input', function() {
                document.getElementById('hiddenQuantityBuy').value = this.value;
                document.getElementById('hiddenQuantityCart').value = this.value;
            });
        </script>

    </div>
</div>

<script>
    // Update the hidden quantity value when the quantity input changes
    document.getElementById('quantity').addEventListener('input', function() {
        document.getElementById('hiddenQuantity').value = this.value;
    });
</script>

<div class="supplier-info">
    <h3>Thông tin nhà cung cấp</h3>
    <p><strong>Tên nhà cung cấp: </strong>{{ $sanPham->nhaCungCap->tenNCC }}</p>
    <p><strong>Địa chỉ: </strong>{{ $sanPham->nhaCungCap->diaChi }}</p>
    <p><strong>Số điện thoại: </strong>{{ $sanPham->nhaCungCap->sdt }}</p>
    <p><strong>Xuất xứ: </strong>{{ $sanPham->nhaCungCap->xuatXu }}</p>
</div>

<div class="product-rating">
    <h4>Đánh giá sản phẩm</h4>
    @if ($sanPham->chiTietDonHangs->isEmpty())
        <p>Chưa có đánh giá nào.</p>
    @else
        @foreach ($sanPham->chiTietDonHangs as $chiTiet)
            @foreach ($chiTiet->danhGiaSanPhams as $danhGia)
                <div style="margin-bottom: 10px;">
                    <p><strong>Số sao: </strong>{{ $danhGia->soLuongSao }} sao</p>
                    <p><strong>Nội dung: </strong>{{ $danhGia->noiDung }}</p>
                </div>
            @endforeach
        @endforeach
    @endif
</div>
@endsection
