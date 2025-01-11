@extends('owner.layouts.app')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
    <div class="container mt-5">
        <h1>Danh sách tin đăng</h1>

        <!-- Nút thêm sản phẩm mới -->
        <a href="{{ route('supplier.post_product.create') }}" class="btn btn-primary mb-3">Đăng tin sản phẩm</a>

        <!-- Bảng thông tin sản phẩm -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Mô Tả</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Đơn Vị Tính</th>
                    <th>Ngày Sản Xuất</th>
                    <th>Ngày Hết Hạn</th>
                    <th>Số Lượng</th>
                    <th>Sản Phẩm Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->tenSP }}</td>
                        <td>{{ $product->moTa }}</td>
                        <td>{{ number_format($product->giaSP, 0, ',', '.') }} VND</td>
                        <td>{{ $product->donViTinh }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->ngaySanXuat)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->ngayHetHan)->format('d/m/Y') }}</td>
                        <td>{{ $product->soLuong }}</td>
                        <td>
                            @if($product->hinhanhtindang->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->hinhanhtindang->first()->hinhanh) }}" alt="Hình ảnh sản phẩm" style="width: 100px; height: 100px;">
                            @else
                                <span>Chưa có hình ảnh</span>
                            @endif
                        </td>
                        <td>
                            <!-- Nút sửa -->
                            <a href="{{ route('supplier.post_product.edit', $product->maTin) }}" class="btn btn-warning btn-sm">Sửa</a>

                            <!-- Nút xóa -->
                            <form action="{{ route('supplier.post_product.destroy', $product->maTin) }}" method="POST" style="display:inline;">
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
