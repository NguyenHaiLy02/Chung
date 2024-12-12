<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbDonHang;
use Illuminate\Support\Facades\DB;

class OwnerOrderController extends Controller
{
    public function viewOrders()
    {
        $statuses = [
            'Tất cả đơn hàng',
            'Chờ xử lý',
            'Chờ vận chuyển',
            'Hoàn thành',
            'Đã hủy'
        ];

        // Gộp đơn hàng theo trạng thái
        $allOrders = TbDonHang::with('chiTietDonHangs.sanPham')
            ->orderBy('ngayDatHang', 'desc')
            ->get();

        $groupedOrders = [
            'Tất cả đơn hàng' => $allOrders,
            'Chờ xử lý' => $allOrders->where('trangThaiDonHang', 'Đang xử lý'),
            'Chờ vận chuyển' => $allOrders->where('trangThaiDonHang', 'Đang vận chuyển'),
            'Hoàn thành' => $allOrders->whereIn('trangThaiDonHang', ['Đã giao hàng', 'Đã nhận', 'Đã đánh giá']),
            'Đã hủy' => $allOrders->where('trangThaiDonHang', 'Đã hủy'),
        ];

        return view('owner.order.index', compact('groupedOrders', 'statuses'));
    }

    public function viewOrderDetail($maDonHang)
    {
        // Fetch the order with related details
        $order = TbDonHang::with('chiTietDonHangs.sanPham')
                    ->where('maDonHang', $maDonHang)
                    ->first();

        // Fetch the order details using raw SQL query
        $orderDetails = DB::table('tbdonhang')
            ->join('tbchitietdonhang', 'tbdonhang.maDonHang', '=', 'tbchitietdonhang.maDonHang')
            ->join('tbsanpham', 'tbchitietdonhang.maSanPham', '=', 'tbsanpham.maSanPham')
            ->join('tbhinhanhsp', 'tbsanpham.maSanPham', '=', 'tbhinhanhsp.maSanPham')
            ->where('tbdonhang.maDonHang', '=', $maDonHang)
            ->select(
                'tbdonhang.maDonHang',
                'tbdonhang.tongTien',
                'tbdonhang.ngayDatHang',
                'tbdonhang.trangThaiDonHang',
                'tbdonhang.trangThaiThanhToan',
                DB::raw('MAX(tbhinhanhsp.hinhAnh) AS hinhAnh'),
                'tbsanpham.tenSanPham',
                'tbchitietdonhang.maChiTietDonHang',
                'tbchitietdonhang.soLuong',
                'tbchitietdonhang.donGia',
                'tbchitietdonhang.daDanhGia'
            )
            ->groupBy(
                'tbdonhang.maDonHang',
                'tbdonhang.tongTien',
                'tbdonhang.ngayDatHang',
                'tbdonhang.trangThaiDonHang',
                'tbdonhang.trangThaiThanhToan',
                'tbsanpham.tenSanPham',
                'tbchitietdonhang.maChiTietDonHang',
                'tbchitietdonhang.soLuong',
                'tbchitietdonhang.donGia',
                'tbchitietdonhang.daDanhGia'
            )
            ->get();

        return view('owner.order.orderDetail', compact('orderDetails', 'order'));
    }

    public function confirmOrder(Request $request, $maDonHang)
    {
        $order = TbDonHang::where('maDonHang', $maDonHang)->first();
    
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Đơn hàng không tồn tại'], 404);
        }
    
        $order->trangThaiDonHang = $request->status;
        $order->save();
    
        return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật']);
    }
}
