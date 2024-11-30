<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TbTaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký.
     */
    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'taiKhoan' => 'required|unique:tbtaikhoan,taiKhoan|max:50',
            'email' => 'required|email|unique:tbtaikhoan,email|max:100',
            'matKhau' => 'required|min:6',
        ]);

        // Lưu tài khoản vào cơ sở dữ liệu
        $user = TbTaiKhoan::create([
            'taiKhoan' => $request->taiKhoan,
            'email' => $request->email,
            'matKhau' => Hash::make($request->matKhau),
            'quyen' => 'khachhang',
            'verify_email' => false,
        ]);

        // Gửi email xác thực
        event(new Registered($user));

        // Chuyển hướng với thông báo
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.');
    }
}
