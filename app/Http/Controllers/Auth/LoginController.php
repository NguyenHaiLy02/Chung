<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TbTaiKhoan;

class LoginController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập.
     */
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'login' => 'required',
            'matKhau' => 'required',
        ], [
            'login.required' => 'Vui lòng nhập tài khoản hoặc email.',
            'matKhau.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Tìm tài khoản
        $user = TbTaiKhoan::where('taiKhoan', $request->login)
            ->orWhere('email', $request->login)
            ->first();

        // Kiểm tra tài khoản và mật khẩu
        if ($user && Hash::check($request->matKhau, $user->matKhau)) {
            if ($user->status === 'inactive') {
                return back()->withErrors(['login' => 'Tài khoản đã bị vô hiệu hóa.'])->withInput();
            }

            if (!$user->verify_email) {
                return back()->withErrors(['login' => 'Vui lòng xác thực email.'])->withInput();
            }

            // Thiết lập session và đăng nhập
            session()->put('username', $user->taiKhoan);
            Auth::login($user);

            // Điều hướng dựa trên quyền
            $redirectRoutes = [
                'khachhang' => 'home.index',
                'chucuahang' => 'shop.dashboard',
                'nhanvien' => 'employee.dashboard',
                'nhanviengiaohang' => 'delivery.dashboard',
                'nhacungcap' => 'supplier.dashboard',
            ];

            $route = $redirectRoutes[$user->quyen] ?? null;

            if ($route) {
                return redirect()->route($route)->with('success', 'Đăng nhập thành công.');
            }

            return back()->withErrors(['login' => 'Quyền không được hỗ trợ.'])->withInput();
        }

        return back()->withErrors(['login' => 'Tài khoản, email hoặc mật khẩu không đúng.'])->withInput();
    }

    /**
     * Xử lý đăng xuất.
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login'); // Hoặc route khác
    }
}
