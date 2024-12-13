@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2  class="text-center mb-0" >Danh sách tài khoản khách hàng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tài khoản</th>
                <th style="white-space: nowrap;" >Tên khách hàng</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->taiKhoan }}</td>
                    <td >{{ $account->khachHang->tenTaiKhoan ?? 'Chưa có thông tin' }}</td>
                    <td>{{ $account->email }}</td>
                    <td>{{ $account->khachHang->sdt ?? 'N/A' }}</td>
                    <td>{{ $account->khachHang->diaChi ?? 'N/A' }}</td>
                    <td>
                        <div class="d-inline-flex">
                            <a href="{{ route('owner.customer_management.edit', $account->taiKhoan) }}" class="btn btn-warning btn-sm me-2">Sửa</a>
                            <form action="{{ route('owner.customer_management.destroy', $account->taiKhoan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
