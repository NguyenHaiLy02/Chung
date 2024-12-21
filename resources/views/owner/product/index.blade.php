@extends('owner.layouts.app')
@section('title', 'Trang người bán')
@section('content')
<div class="container">
    <h1>Danh sách sản phẩm</h1>
    <a href="{{ route('owner.product.create') }}" class="btn btn-success mb-3">Thêm sản phẩm</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Cách bảo quản</th>
                <th>Giá tiền</th>
                <th>Đơn vị tính</th>
                <th>Ngày sản xuất</th>
                <th>Ngày hết hạn</th>
                <th>Số lượng tồn kho</th>
                <th>Nhà cung cấp</th>
                <th>Danh mục</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->maSanPham }}</td>
                <td>{{ $product->tenSanPham }}</td>
                <td>{{ $product->moTa }}</td>
                <td>{{ $product->cachBaoQuan }}</td>
                <td>{{ number_format($product->giaTien, 0, ',', '.') }} đ</td>
                <td>{{ $product->donViTinh }}</td>
                <td>{{ $product->ngaySanXuat }}</td>
                <td>{{ $product->ngayHetHan }}</td>
                <td>{{ $product->soLuongTonKho }}</td>
                <td>{{ $product->nhaCungCap->tenNCC ?? 'Không xác định' }}</td>
                <td>{{ $product->danhMuc->tenDanhMuc ?? 'Không xác định' }}</td>
                <td>
                    @if($product->hinhAnhSps->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->hinhAnhSps->first()->hinhAnh) }}" alt="Hình ảnh sản phẩm" style="width: 100px; height: auto;">
                    @else
                        <span>Chưa có hình ảnh</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('owner.product.edit', $product->maSanPham) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('owner.product.destroy', $product->maSanPham) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
