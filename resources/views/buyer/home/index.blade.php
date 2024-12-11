    @extends('buyer.layouts.app')
    @section('title', 'DANAMART')
    @section('content')
        <section class="py-3"
            style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="banner-blocks">

                            <div class="banner-ad large bg-info block-1">

                                <div class="swiper main-swiper">
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide">
                                            <div class="row banner-content p-5">
                                                <div class="content-wrapper col-md-7">
                                                    <div class="categories my-3">100% natural</div>
                                                    <h3 class="display-4">Fresh Smoothie & Summer Juice</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim
                                                        massa
                                                        diam elementum.</p>
                                                    <a href="#"
                                                        class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop
                                                        Now</a>
                                                </div>
                                                <div class="img-wrapper col-md-5">
                                                    <img src="images/product-thumb-1.png" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="row banner-content p-5">
                                                <div class="content-wrapper col-md-7">
                                                    <div class="categories mb-3 pb-3">100% natural</div>
                                                    <h3 class="banner-title">Fresh Smoothie & Summer Juice</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim
                                                        massa
                                                        diam elementum.</p>
                                                    <a href="#"
                                                        class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop
                                                        Collection</a>
                                                </div>
                                                <div class="img-wrapper col-md-5">
                                                    <img src="images/product-thumb-1.png" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="row banner-content p-5">
                                                <div class="content-wrapper col-md-7">
                                                    <div class="categories mb-3 pb-3">100% natural</div>
                                                    <h3 class="banner-title">Heinz Tomato Ketchup</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim
                                                        massa
                                                        diam elementum.</p>
                                                    <a href="#"
                                                        class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop
                                                        Collection</a>
                                                </div>
                                                <div class="img-wrapper col-md-5">
                                                    <img src="images/product-thumb-2.png" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-pagination"></div>

                                </div>
                            </div>

                            <div class="banner-ad bg-success-subtle block-2"
                                style="background:url('images/ad-image-1.png') no-repeat;background-position: right bottom">
                                <div class="row banner-content p-5">

                                    <div class="content-wrapper col-md-7">
                                        <div class="categories sale mb-3 pb-3">20% off</div>
                                        <h3 class="banner-title">Fruits & Vegetables</h3>
                                        <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg
                                                width="24" height="24">
                                                <use xlink:href="#arrow-right"></use>
                                            </svg></a>
                                    </div>

                                </div>
                            </div>

                            <div class="banner-ad bg-danger block-3"
                                style="background:url('images/ad-image-2.png') no-repeat;background-position: right bottom">
                                <div class="row banner-content p-5">

                                    <div class="content-wrapper col-md-7">
                                        <div class="categories sale mb-3 pb-3">15% off</div>
                                        <h3 class="item-title">Baked Products</h3>
                                        <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg
                                                width="24" height="24">
                                                <use xlink:href="#arrow-right"></use>
                                            </svg></a>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- / Banner Blocks -->

                    </div>
                </div>
            </div>
        </section>

        <!-- Trending Products Section -->
        <section class="py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bootstrap-tabs product-tabs">
                            <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                                <h3>Danh Mục</h3>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <!-- Tab "Tất cả" là mặc định active -->
                                        <a href="#" class="nav-link text-uppercase fs-6 active" id="nav-all-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-all">Tất cả</a>
                                        @foreach ($danhMucs as $category)
                                            <a href="#" class="nav-link text-uppercase fs-6"
                                                id="nav-{{ $category->maDanhMuc }}-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-{{ $category->maDanhMuc }}">{{ $category->tenDanhMuc }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                            </div>

                            <div class="tab-content" id="nav-tabContent">
                                <!-- Tab "Tất cả" -->
                                <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                                    aria-labelledby="nav-all-tab">
                                    <div
                                        class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                        @foreach ($allSanPhams as $sanPham)
                                            <div class="col">
                                                <div class="product-item">
                                                    <span class="badge bg-success position-absolute m-3">-30%</span>

                                                    <figure>
                                                        <a href="{{ route('buyer.sanpham.detail', ['id' => $sanPham->maSanPham]) }}"
                                                            title="{{ $sanPham->tenSanPham }}"
                                                            title="{{ $sanPham->tenSanPham }}"
                                                            title="{{ $sanPham->tenSanPham }}">
                                                            @foreach ($sanPham->hinhAnhSps as $hinhAnh)
                                                                <img src="{{ asset('storage/' . $hinhAnh->hinhAnh) }}"
                                                                    class="tab-image" class="product-image">
                                                            @break
                                                        @endforeach
                                                    </a>
                                                </figure>
                                                <a href="{{ route('buyer.sanpham.detail', ['id' => $sanPham->maSanPham]) }}"
                                                    title="{{ $sanPham->tenSanPham }}">
                                                    <h3>{{ $sanPham->tenSanPham }}</h3>
                                                </a>
                                                <span class="qty">{{ $sanPham->soLuongTonKho }} Units</span>
                                                <span class="rating">
                                                    <svg width="24" height="24" class="text-primary">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg> 4.5
                                                </span>
                                                <span class="price">${{ $sanPham->giaTien }}</span>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @foreach ($danhMucs as $category)
                                <div class="tab-pane fade" id="nav-{{ $category->maDanhMuc }}" role="tabpanel"
                                    aria-labelledby="nav-{{ $category->maDanhMuc }}-tab">
                                    <div
                                        class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                        @foreach ($category->sanPhams as $sanPham)
                                            <div class="col">
                                                <div class="product-item">
                                                    <span class="badge bg-success position-absolute m-3">-30%</span>
                                                    <a href="{{ route('buyer.sanpham.detail', ['id' => $sanPham->maSanPham]) }}"
                                                        title="{{ $sanPham->tenSanPham }}"
                                                        title="{{ $sanPham->tenSanPham }}" class="btn-wishlist">
                                                        <svg width="24" height="24">
                                                            <use xlink:href="#heart"></use>
                                                        </svg>
                                                    </a>
                                                    <figure>
                                                        <!-- Chuyển đến trang chi tiết sản phẩm -->
                                                        <a href="{{ route('buyer.sanpham.detail', ['id' => $sanPham->maSanPham]) }}"
                                                            title="{{ $sanPham->tenSanPham }}">
                                                            @foreach ($sanPham->hinhAnhSps as $hinhAnh)
                                                                <img src="{{ asset('storage/' . $hinhAnh->hinhAnh) }}"
                                                                    class="tab-image" class="product-image">
                                                            @break
                                                        @endforeach
                                                    </a>

                                                    </a>
                                                </figure>
                                                <h3>{{ $sanPham->tenSanPham }}</h3>
                                                <span class="qty">{{ $sanPham->soLuongTonKho }} Units</span>
                                                <span class="rating">
                                                    <svg width="24" height="24" class="text-primary">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg> 4.5
                                                </span>
                                                <span class="price">${{ $sanPham->giaTien }}</span>

                                                
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
<style>
.product-image {
    width: 100%;
    /* Đảm bảo hình ảnh chiếm toàn bộ không gian của phần chứa */
    height: auto;
    /* Giữ tỷ lệ của hình ảnh */
    object-fit: cover;
    /* Đảm bảo hình ảnh không bị méo và tự động cắt để phù hợp */
    /* border-radius: 8px; Bo góc của hình ảnh */
    transition: transform 0.3s ease;
    /* Thêm hiệu ứng khi hover */
}

.product-image:hover {
    transform: scale(1.1);
    /* Phóng to hình ảnh khi hover */
}

.product-item figure {
    position: relative;
    overflow: hidden;
    /* Đảm bảo hình ảnh không bị tràn ra ngoài */
}

.product-item {
    position: relative;
    margin-bottom: 30px;
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
}

.product-item h3 {
    font-size: 16px;
    font-weight: 600;
    margin-top: 15px;
}

.product-item .price {
    font-size: 18px;
    font-weight: 700;
    color: #f44d58;
    margin-top: 10px;
}
</style>
