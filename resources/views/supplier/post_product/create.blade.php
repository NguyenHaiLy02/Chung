@extends('owner.layouts.app')

@section('title', 'Đăng tin Sản Phẩm')

@section('content')
    <div class="container mt-5">
        <h1>Thêm Sản Phẩm Mới</h1>

        <!-- Hiển thị thông báo thành công nếu có -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form thêm sản phẩm -->
        <form action="{{ route('supplier.post_product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tên Sản Phẩm -->
            <div class="form-group">
                <label for="tenSP">Tên Sản Phẩm</label>
                <input type="text" id="tenSP" name="tenSP" class="form-control @error('tenSP') is-invalid @enderror" value="{{ old('tenSP') }}">
                @error('tenSP')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô Tả -->
            <div class="form-group">
                <label for="moTa">Mô Tả</label>
                <textarea id="moTa" name="moTa" class="form-control @error('moTa') is-invalid @enderror">{{ old('moTa') }}</textarea>
                @error('moTa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Giá Sản Phẩm -->
            <div class="form-group">
                <label for="giaSP">Giá Sản Phẩm</label>
                <input type="number" id="giaSP" name="giaSP" class="form-control @error('giaSP') is-invalid @enderror" value="{{ old('giaSP') }}">
                @error('giaSP')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Đơn Vị Tính -->
            <div class="form-group">
                <label for="donViTinh">Đơn Vị Tính</label>
                <input type="text" id="donViTinh" name="donViTinh" class="form-control @error('donViTinh') is-invalid @enderror" value="{{ old('donViTinh') }}">
                @error('donViTinh')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ngày Sản Xuất -->
            <div class="form-group">
                <label for="ngaySanXuat">Ngày Sản Xuất</label>
                <input type="date" id="ngaySanXuat" name="ngaySanXuat" class="form-control @error('ngaySanXuat') is-invalid @enderror" value="{{ old('ngaySanXuat') }}">
                @error('ngaySanXuat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ngày Hết Hạn -->
            <div class="form-group">
                <label for="ngayHetHan">Ngày Hết Hạn</label>
                <input type="date" id="ngayHetHan" name="ngayHetHan" class="form-control @error('ngayHetHan') is-invalid @enderror" value="{{ old('ngayHetHan') }}">
                @error('ngayHetHan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Số Lượng -->
            <div class="form-group">
                <label for="soLuong">Số Lượng</label>
                <input type="number" id="soLuong" name="soLuong" class="form-control @error('soLuong') is-invalid @enderror" value="{{ old('soLuong') }}">
                @error('soLuong')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hình Ảnh -->
            <div class="form-group">
                <label for="hinhanh">Hình Ảnh</label>
                <input 
                    type="file" 
                    id="hinhanh" 
                    name="hinhanh[]" 
                    class="form-control @error('hinhanh.*') is-invalid @enderror" 
                    multiple
                >
                @error('hinhanh.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>            

            <!-- Nút Thêm -->
            <button type="submit" class="btn btn-success">Thêm Sản Phẩm</button>
        </form>
    </div>
@endsection
