<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbTaiKhoan;
use App\Models\TbKhachHang;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Hiển thị danh sách tài khoản khách hàng.
     */
    public function index()
    {
        $accounts = TbTaiKhoan::where('quyen', 'khachhang')->with('khachHang')->get();
        return view('owner.customer_management.index', compact('accounts'));
    }

    /**
     * Hiển thị form chỉnh sửa tài khoản khách hàng.
     */
    public function edit($taiKhoan)
    {
        $account = TbTaiKhoan::where('taiKhoan', $taiKhoan)->with('khachHang')->firstOrFail();
        return view('owner.customer_management.edit', compact('account'));
    }

    /**
     * Cập nhật thông tin tài khoản khách hàng.
     */
    public function update(Request $request, $taiKhoan)
    {
        $request->validate([
            'tenTaiKhoan' => 'required|string|max:255',
            'sdt' => 'nullable|string|max:15',
            'diaChi' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $account = TbTaiKhoan::where('taiKhoan', $taiKhoan)->firstOrFail();
        $account->update([
            'email' => $request->email,
        ]);

        $account->khachHang()->update([
            'tenTaiKhoan' => $request->tenTaiKhoan,
            'sdt' => $request->sdt,
            'diaChi' => $request->diaChi,
        ]);

        return redirect()->route('owner.customer_management.index')->with('success', 'Cập nhật tài khoản thành công.');
    }

    /**
     * Xóa tài khoản khách hàng.
     */
    public function destroy($taiKhoan)
    {
        $account = TbTaiKhoan::where('taiKhoan', $taiKhoan)->firstOrFail();

        // Kiểm tra quan hệ
        if ($account->khachHang) {
            $account->khachHang->delete();
        }

        $account->delete();

        return redirect()->route('owner.customer_management.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
