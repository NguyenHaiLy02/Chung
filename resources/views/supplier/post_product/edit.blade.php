@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa sản phẩm</h2>

    <form action="{{ route('supplier.post_product.update', $product->maTin) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')  <!-- Sử dụng phương thức PUT để cập nhật dữ liệu -->
        
        <div class="form-group">
            <label for="tenSP">Tên sản phẩm</label>
            <input type="text" class="form-control @error('tenSP') is-invalid @enderror" id="tenSP" name="tenSP" value="{{ old('tenSP', $product->tenSP) }}" required>
            @error('tenSP')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="moTa">Mô tả</label>
            <textarea class="form-control @error('moTa') is-invalid @enderror" id="moTa" name="moTa">{{ old('moTa', $product->moTa) }}</textarea>
            @error('moTa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="giaSP">Giá sản phẩm</label>
            <input type="number" class="form-control @error('giaSP') is-invalid @enderror" id="giaSP" name="giaSP" value="{{ old('giaSP', $product->giaSP) }}" required>
            @error('giaSP')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="donViTinh">Đơn vị tính</label>
            <input type="text" class="form-control @error('donViTinh') is-invalid @enderror" id="donViTinh" name="donViTinh" value="{{ old('donViTinh', $product->donViTinh) }}" required>
            @error('donViTinh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="ngaySanXuat">Ngày sản xuất</label>
            <input type="date" class="form-control @error('ngaySanXuat') is-invalid @enderror" id="ngaySanXuat" name="ngaySanXuat" value="{{ old('ngaySanXuat', $product->ngaySanXuat) }}" required>
            @error('ngaySanXuat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="ngayHetHan">Ngày hết hạn</label>
            <input type="date" class="form-control @error('ngayHetHan') is-invalid @enderror" id="ngayHetHan" name="ngayHetHan" value="{{ old('ngayHetHan', $product->ngayHetHan) }}" required>
            @error('ngayHetHan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="soLuong">Số lượng</label>
            <input type="number" class="form-control @error('soLuong') is-invalid @enderror" id="soLuong" name="soLuong" value="{{ old('soLuong', $product->soLuong) }}" required>
            @error('soLuong')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hinhanh">Hình ảnh</label>
            <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh[]" multiple>
            @error('hinhanh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div>
                @foreach($product->hinhanhtindang as $image)
                    <img src="{{ asset('storage/' . $image->hinhAnh) }}" alt="image" width="100px" height="100px">
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('supplier.post_product.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
