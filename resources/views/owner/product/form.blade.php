@extends('owner.layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($product) ? 'Sửa sản phẩm' : 'Thêm mới sản phẩm' }}</h1>
        <form
            action="{{ isset($product) ? route('owner.product.update', $product->maSanPham) : route('owner.product.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="tenSanPham">Tên sản phẩm</label>
                <input type="text" name="tenSanPham" id="tenSanPham" class="form-control"
                    value="{{ old('tenSanPham', $product->tenSanPham ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="moTa">Mô tả</label>
                <textarea name="moTa" id="moTa" class="form-control">{{ old('moTa', $product->moTa ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="cachBaoQuan">Cách bảo quản</label>
                <input type="text" name="cachBaoQuan" id="cachBaoQuan" class="form-control"
                    value="{{ old('cachBaoQuan', $product->cachBaoQuan ?? '') }}">
            </div>

            <div class="form-group">
                <label for="giaTien">Giá tiền</label>
                <input type="number" name="giaTien" id="giaTien" class="form-control"
                    value="{{ old('giaTien', $product->giaTien ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="donViTinh">Đơn vị tính</label>
                <input type="text" name="donViTinh" id="donViTinh" class="form-control"
                    value="{{ old('donViTinh', $product->donViTinh ?? '') }}">
            </div>

            <div class="form-group">
                <label for="ngaySanXuat">Ngày sản xuất</label>
                <input type="date" name="ngaySanXuat" id="ngaySanXuat" class="form-control"
                    value="{{ old('ngaySanXuat', $product->ngaySanXuat ?? '') }}">
            </div>

            <div class="form-group">
                <label for="ngayHetHan">Ngày hết hạn</label>
                <input type="date" name="ngayHetHan" id="ngayHetHan" class="form-control"
                    value="{{ old('ngayHetHan', $product->ngayHetHan ?? '') }}">
            </div>

            <div class="form-group">
                <label for="soLuongTonKho">Số lượng tồn kho</label>
                <input type="number" name="soLuongTonKho" id="soLuongTonKho" class="form-control"
                    value="{{ old('soLuongTonKho', $product->soLuongTonKho ?? '') }}">
            </div>

            <div class="form-group">
                <label for="maNCC">Nhà cung cấp</label>
                <select name="maNCC" id="maNCC" class="form-control" required>
                    <option value="">-- Chọn nhà cung cấp --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->maNCC }}"
                            {{ isset($product) && $product->maNCC == $supplier->maNCC ? 'selected' : '' }}>
                            {{ $supplier->tenNCC }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="maDanhMuc">Danh mục</label>
                <select name="maDanhMuc" id="maDanhMuc" class="form-control" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->maDanhMuc }}"
                            {{ isset($product) && $product->maDanhMuc == $category->maDanhMuc ? 'selected' : '' }}>
                            {{ $category->tenDanhMuc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hinhAnh">Hình ảnh</label>
                <input type="file" name="hinhAnh[]" id="hinhAnh" class="form-control" multiple>

                @if (isset($product) && $product->hinhAnhSps->isNotEmpty())
                    <div class="mt-2">
                        @foreach ($product->hinhAnhSps as $image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $image->hinhAnh) }}" alt="Hình ảnh sản phẩm"
                                    style="width: 100px;">

                                <!-- Checkbox nằm trên hình ảnh -->
                                <label class="delete-checkbox">Xóa</label>
                                <label class="delete-checkbox">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image->maHinhAnh }}">
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}</button>
        </form>
    </div>
@endsection
<style>
    .image-container {
    position: relative;
    display: inline-block;
    margin-right: 10px;
}

.image-container img {
    width: 100px;  /* Đặt chiều rộng cố định cho hình ảnh */
    height: 100px; /* Đặt chiều cao cố định cho hình ảnh */
    object-fit: cover; /* Giữ tỷ lệ và cắt bớt nếu cần */
}

.delete-checkbox {
    position: absolute;
    right: 5px;
    top: 5px;
    color: white;
    background-color: rgba(255, 0, 0, 0.6);
    border: none;
    padding: 5px;
    cursor: pointer;
    z-index: 10;
    border-radius: 5px;
}

.delete-checkbox input {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

</style>
