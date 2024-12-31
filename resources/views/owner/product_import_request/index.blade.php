@extends('owner.layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Danh sách yêu cầu nhập hàng</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Yêu Cầu</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái Yêu Cầu</th>
                    <th>Trạng Thái Thanh Toán</th>
                    <th>Ngày Nhận Dự Kiến</th>
                    <th>Ngày Nhận Thực Tế</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->maYeuCau }}</td>
                        <td>{{ number_format($request->tongTien, 0, ',', '.') }} VND</td>
                        <td>{{ ucfirst($request->trangThaiYeuCau) }}</td>
                        <td>{{ ucfirst($request->trangThaiThanhToan) }}</td>
                        <td>{{ $request->ngayNhanDuKien}}</td>
                        <td>{{ $request->ngayNhanThucTe}}</td>
                        <td>
                            <a href="{{ route('owner.product_import_request.show', $request->maYeuCau) }}"
                                class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                        <td>
                            <form
                                action="{{ route('supplier.product_export_management.update_status', $request->maYeuCau) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                @if ($request->trangThaiYeuCau == 'Đã duyệt')
                                    <button type="submit" class="btn btn-warning btn-sm">Xác nhận đơn</button>
                                @else
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có yêu cầu nhập hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
@endsection
