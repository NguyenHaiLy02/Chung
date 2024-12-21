@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Quản lý nhà cung cấp</h1>

    <!-- Bộ lọc trạng thái -->
    <form action="{{ route('owner.supplier_management.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="filter" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Tất cả</option>
                    <option value="approved" {{ $filter === 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>Chưa duyệt</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Bảng danh sách nhà cung cấp -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tài khoản</th>
                <th>Tên nhà cung cấp</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Xuất xứ</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
                <th>Xem chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->maNCC }}</td>
                <td>{{ $supplier->taiKhoan }}</td>
                <td>{{ $supplier->tenNCC }}</td>
                <td>{{ $supplier->diaChi }}</td>
                <td>{{ $supplier->sdt }}</td>
                <td>{{ $supplier->xuatXu }}</td>
                <td>{{ $supplier->danhMuc->tenDanhMuc ?? 'Không có danh mục' }}</td>
                <td>{{ $supplier->pheDuyet ? 'Đã duyệt' : 'Chưa duyệt' }}</td>
                <td>
                    @if(!$supplier->pheDuyet)
                        <form action="{{ route('owner.supplier_management.approve', $supplier->maNCC) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Phê duyệt</button>
                        </form>
                    @endif
                </td>
                <td>
                    <a href="{{ route('owner.supplier_management.show', $supplier->maNCC) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    
</div>
@endsection
