@extends('owner.layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Danh sách yêu cầu</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Yêu Cầu</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái Yêu Cầu</th>
                    <th>Trạng Thái Thanh Toán</th>
                    <th>Ngày Nhận Dự Kiến</th>
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
                        <td>{{ \Carbon\Carbon::parse($request->ngayNhanDuKien)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('supplier.product_export_management.show', $request->maYeuCau) }}"
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
                                @if ($request->trangThaiYeuCau == 'Chờ duyệt')
                                    <button type="submit" class="btn btn-warning btn-sm">Xác nhận đơn</button>
                                @elseif ($request->trangThaiYeuCau == 'Đã nhận hàng')
                                    <label for="" class="text-success">Giao hàng thành công</label>
                                @elseif ($request->trangThaiYeuCau == 'Số lượng không đủ')
                                    <label for="" class="text-danger">Đã hủy đơn</label>
                                @else
                                    <label for="" class="text-info">Đã duyệt đơn</label>
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
