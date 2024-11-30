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
    /**
 * Xử lý đăng nhập.
 */
public function login(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'login' => 'required', // Có thể là 'taiKhoan' hoặc 'email'
        'matKhau' => 'required',
    ], [
        'login.required' => 'Vui lòng nhập tài khoản hoặc email.',
        'matKhau.required' => 'Vui lòng nhập mật khẩu.',
    ]);

    // Tìm tài khoản dựa trên 'login'
    $user = TbTaiKhoan::where('taiKhoan', $request->login)
        ->orWhere('email', $request->login)
        ->first();

    // Kiểm tra tài khoản và mật khẩu
    if ($user && Hash::check($request->matKhau, $user->matKhau)) {
        // Kiểm tra trạng thái tài khoản (nếu bị khóa hoặc vô hiệu hóa)
        if ($user->status === 'inactive') {
            return back()->withErrors([
                'login' => 'Tài khoản của bạn đã bị vô hiệu hóa.',
            ])->withInput();
        }

        // Kiểm tra xác thực email
        if (!$user->verify_email) { // Cột `verify_email` lưu trạng thái xác thực email
            return back()->withErrors([
                'login' => 'Tài khoản của bạn chưa được xác thực email. Vui lòng kiểm tra hộp thư.',
            ])->withInput();
        }

        // Đăng nhập tài khoản
        Auth::login($user);

        // Chuyển hướng dựa trên quyền (role)
        switch ($user->quyen) {
            case 'khachhang':
                return redirect()->route('home.index')->with('success', 'Đăng nhập thành công.');
            case 'chucuahang':
                return redirect()->route('')->with('success', 'Đăng nhập thành công.');
            case 'nhanvien':
                return redirect()->route('')->with('success', 'Đăng nhập thành công.');
            case 'nhanviengiaohang':
                return redirect()->route('')->with('success', 'Đăng nhập thành công.');
            case 'nhacungcap':
                return redirect()->route('')->with('success', 'Đăng nhập thành công.');
            default:
                return back()->withErrors([
                    'login' => 'Quyền của bạn không được hỗ trợ.',
                ])->withInput();
        }
    }
    // Trả về lỗi nếu không đăng nhập được
    return back()->withErrors([
        'login' => 'Tài khoản, email hoặc mật khẩu không đúng.',
    ])->withInput();
}


    /**
     * Xử lý đăng xuất.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đã đăng xuất.');
    }
}
