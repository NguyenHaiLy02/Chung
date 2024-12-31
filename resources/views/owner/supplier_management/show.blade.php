@extends('owner.layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Chi tiết nhà cung cấp</h1>

        <!-- Thông tin nhà cung cấp -->
        <div class="card mb-4">
            <div class="card-header">Thông tin chung</div>
            <div class="card-body">
                <p><strong>Tài khoản:</strong> {{ $supplier->TaiKhoan->taiKhoan ?? 'Chưa có' }}</p>
                <p><strong>Tên nhà cung cấp:</strong> {{ $supplier->tenNCC }}</p>
                <p><strong>Địa chỉ:</strong> {{ $supplier->diaChi }}</p>
                <p><strong>Số điện thoại:</strong> {{ $supplier->sdt }}</p>
                <p><strong>Xuất xứ:</strong> {{ $supplier->xuatXu }}</p>
                <p><strong>Trạng thái:</strong> {{ $supplier->pheDuyet ? 'Đã duyệt' : 'Chưa duyệt' }}</p>
            </div>
        </div>

        <!-- Danh sách chứng nhận -->
        <div class="card mb-4">
            <div class="card-header">Chứng nhận</div>
            <div class="card-body">
                @if ($supplier->chungNhans->count() > 0)
                    <div class="row">
                        @foreach ($supplier->chungNhans as $chungNhan)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $chungNhan->hinhanh) }}" alt="Chứng nhận"
                                    class="img-fluid rounded">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Không có chứng nhận</p>
                @endif
            </div>
        </div>

        <form action="{{ route('order-request.submit') }}" method="POST">
            @csrf
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
                        <th>Số lượng muốn nhập</th>
                        <th>Chọn nhập</th>
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
                                <input type="number" name="quantity[{{ $product->maTin }}]" min="1" max="{{ $product->soLuong }}" class="form-control">
                            </td>
                            <td>
                                <input type="checkbox" name="selected[{{ $product->maTin }}]" value="{{ $product->maTin }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Gửi yêu cầu nhập hàng</button>
            </div>
        </form>        

        <!-- Nút quay lại -->
        <a href="{{ route('owner.supplier_management.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
@endsection
