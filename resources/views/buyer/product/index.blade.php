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
            flex-direction: column;
            align-items: center;
        }

        .main-image img {
            width: 350px;
            height: 350px;
            border-radius: 8px;
            object-fit: cover;
        }

        .thumbnail-images img,
        .thumbnail {
            width: 80px;
            height: 80px;
            margin: 5px;
            border-radius: 5px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
            
            border: 2px solid #ececec;
        }

        .thumbnail-images img {
            width: 80px;
            height: 80px;
        }

        .thumbnail:hover,
        .thumbnail-images img:hover {
            transform: scale(1.1);
            
            border: 2px solid #4c1b1b;
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

        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
            }

            .product-info {
                padding-left: 0;
            }

            .product-images {
                margin-bottom: 20px;
            }
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

        /* @media (max-width: 768px) {
                        .product-detail {
                            flex-direction: column;
                        }

                        .product-info {
                            padding-left: 0;
                        }
                    } */
    </style>

    @if (session('success'))
        <div style="margin-top: 10px; color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-detail">
        <!-- Khung ảnh lớn bên trái -->
        <div class="product-images">
            <div class="main-image">
                <img id="mainImage" src="{{ asset('storage/' . $sanPham->hinhAnhSps[0]->hinhAnh) }}"
                    alt="{{ $sanPham->tenSanPham }}">
            </div>

            <!-- Các khung ảnh nhỏ bên dưới ảnh lớn -->
            <div class="thumbnail-images">
                @foreach ($sanPham->hinhAnhSps as $hinhAnh)
                    <img class="thumbnail" src="{{ asset('storage/' . $hinhAnh->hinhAnh) }}" alt="{{ $sanPham->tenSanPham }}"
                        onclick="changeImage('{{ asset('storage/' . $hinhAnh->hinhAnh) }}')">
                @endforeach
            </div>
        </div>

        <!-- Phần thông tin sản phẩm bên phải -->
        <div class="product-info">
            <h1>{{ $sanPham->tenSanPham }}</h1>
            <p>{{ $sanPham->moTa }}</p>
            <p class="price"><strong>Giá: </strong>{{ number_format($sanPham->giaTien, 0, ',', '.') }} VND</p>
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
        @if ($sanPham->chiTietDonHangs->isEmpty())
            <p>Chưa có đánh giá nào.</p>
        @else
            @foreach ($sanPham->chiTietDonHangs as $chiTiet)
                @foreach ($chiTiet->danhGiaSanPhams as $danhGia)
                    <div style="margin-bottom: 10px; display: flex; align-items: flex-start;">
                        <!-- Ảnh đại diện bên trái -->
                        @php
                            $khachHang = $chiTiet->donHang->khachHang;
                        @endphp
                        @if ($khachHang)
                            <img src="{{ asset('storage/' . $khachHang->anhDaiDien) }}" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                            <!-- Tên tài khoản bên phải -->
                            <div style="flex-grow: 1;">
                                <p style="margin: 0;">{{ $khachHang->taiKhoan }}</p>
                                <!-- Số sao dưới tên tài khoản -->
                                <p style="margin: 0;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $danhGia->soLuongSao)
                                            <span style="color: rgb(238, 20, 20);">&#9733;</span> <!-- Sao vàng -->
                                        @else
                                            <span style="color: gray;">&#9733;</span> <!-- Sao xám -->
                                        @endif
                                    @endfor
                                </p>
                                <p>{{ $danhGia->noiDung }}</p>
                            </div>
                        @else
                            <p>Thông tin khách hàng không có sẵn.</p>
                        @endif
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
    
    
    
    <script>
        // Đảm bảo rằng phần tử mainImage đã được tìm thấy và có thể thay đổi
        function changeImage(imageUrl) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = imageUrl; // Thay đổi ảnh lớn bằng ảnh nhỏ
        }
    </script>

@endsection
