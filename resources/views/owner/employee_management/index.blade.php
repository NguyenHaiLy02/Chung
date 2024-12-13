@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Danh sách nhân viên</h2>

    <a href="{{ route('owner.employee_management.create') }}" class="btn btn-primary mb-3">Thêm nhân viên</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tài khoản</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Chức vụ</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->taiKhoan }}</td>
                    <td>{{ $employee->hoTen }}</td>
                    <td>{{ $employee->TaiKhoan->email ?? "Không tìm thấy"}}</td>
                    <td>{{ $employee->chucVu }}</td>
                    <td>{{ $employee->sdt }}</td>
                    <td>{{ $employee->diachi }}</td>
                    <td>
                        <a href="{{ route('owner.employee_management.edit', $employee->maNhanVien) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('owner.employee_management.destroy', $employee->maNhanVien) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu ngay lập tức
        const userConfirmed = confirm("Bạn có chắc chắn muốn xóa nhân viên này không?");
        if (userConfirmed) {
            event.target.submit(); // Gửi biểu mẫu nếu người dùng nhấn "OK"
        }
    }
</script>

@endsection
