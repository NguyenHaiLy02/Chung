<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;

use App\Models\TbTaiKhoan;
use App\Models\TbKhachHang;
use App\Models\TbDonHang;
use Illuminate\Http\Request;
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
            'Đang xử lý',
            'Đang vận chuyển',
            'Đã giao hàng',
            'Đã hủy'
        ];
    
        // Gộp đơn hàng theo trạng thái
        $orders = TbDonHang::where('taiKhoan', session('username'))
            ->with('chiTietDonHangs.sanPham')
            ->orderBy('ngayDatHang', 'desc')
            ->get()
            ->groupBy('trangThaiDonHang');
    
        // Đảm bảo trạng thái cố định luôn xuất hiện
        $groupedOrders = [];
        foreach ($statuses as $status) {
            $groupedOrders[$status] = $orders->get($status, collect());
        }
    
        return view('buyer.profile.viewOrders', compact('groupedOrders', 'statuses'));
    }
    

    public function viewOrderDetail($maDonHang)
    {
        $order = TbDonHang::with('chiTietDonHangs.sanPham')
            ->where('maDonHang', $maDonHang)
            ->firstOrFail();

        return view('buyer.profile.orderDetail', compact('order'));
    }

}
