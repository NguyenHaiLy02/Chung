<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;

use App\Models\TbTaiKhoan;
use App\Models\TbKhachHang;
use App\Models\TbDonHang;
use App\Models\TbChiTietDonHang;
use App\Models\DanhGiaSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Hiển thị hồ sơ cá nhân.
     */
    public function showProfile()
    {
        $user = TbTaiKhoan::where('taiKhoan', session('username'))->with('khachHang')->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng!');
        }
    
        return view('buyer.profile.profile', compact('user'));
    }
    
    public function edit($id)
    {
        $customer = TbKhachHang::findOrFail($id);
        return view('buyer.profile.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = TbKhachHang::findOrFail($id);
        $customer->update($request->only(['tenTaiKhoan', 'sdt', 'diaChi']));
        if ($request->hasFile('anhDaiDien')) {
            $path = $request->file('anhDaiDien')->store('avatars', 'public');
            $customer->update(['anhDaiDien' => $path]);
        }
        return redirect()->route('profile')->with('success', 'Cập nhật thông tin thành công!');
    }
    /**
     * Hiển thị trang đổi mật khẩu.
     */
    public function showChangePasswordForm()
    {
        return view('buyer.profile.changePassword');
    }

    /**
     * Xử lý đổi mật khẩu.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = TbTaiKhoan::where('taiKhoan', session('username'))->first();

        if (!$user || !Hash::check($request->current_password, $user->getAuthPassword())) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng!']);
        }

        $user->matKhau = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

    /**
     * Hiển thị danh sách đơn hàng.
     */
    public function viewOrders()
    {
        $statuses = [
            'Tất cả đơn hàng',
            'Đang xử lý',
            'Đang vận chuyển',
            'Hoàn thành',
            'Đã hủy'
        ];

        // Gộp đơn hàng theo trạng thái
        $allOrders = TbDonHang::where('taiKhoan', session('username'))
            ->with('chiTietDonHangs.sanPham')
            ->orderBy('ngayDatHang', 'desc')
            ->get();

        $groupedOrders = [
            'Tất cả đơn hàng' => $allOrders,
            'Đang xử lý' => $allOrders->whereIn('trangThaiDonHang',['Đang xử lý','Đã duyệt','Chuẩn bị hàng','Chờ vận chuyển'] ),
            'Đang vận chuyển' => $allOrders->where('trangThaiDonHang', 'Đang vận chuyển'),
            'Hoàn thành' => $allOrders->whereIn('trangThaiDonHang', ['Đã giao hàng', 'Đã nhận', 'Đã đánh giá']),
            'Đã hủy' => $allOrders->where('trangThaiDonHang', 'Đã hủy'),
        ];

        return view('buyer.profile.viewOrders', compact('groupedOrders', 'statuses'));
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

        return view('buyer.profile.orderDetail', compact('orderDetails', 'order'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'maChiTietDonHang' => 'required|exists:tbchitietdonhang,maChiTietDonHang',
            'soLuongSao' => 'required|integer|min:1|max:5',
            'noiDung' => 'nullable|string|max:500',
        ]);

        // Lưu đánh giá
        DanhGiaSanPham::create([
            'maChiTietDonHang' => $request->maChiTietDonHang,
            'soLuongSao' => $request->soLuongSao,
            'noiDung' => $request->noiDung,
        ]);
        TbChiTietDonHang::where('maChiTietDonHang', $request->maChiTietDonHang)
        ->update(['daDanhGia' => true]);

        // Redirect về trang chi tiết đơn hàng với thông báo thành công
        return redirect()->back()->with('success', 'Đánh giá sản phẩm thành công!');
    }
}
