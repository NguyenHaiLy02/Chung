<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\TbTaiKhoan;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        $username = session('username'); // Lấy username từ session
        if ($username) {
            $quyen = TbTaiKhoan::where('taiKhoan', $username)->value('quyen'); // Lấy quyền duy nhất
            if ($quyen === 'khachhang') {
                return $next($request);
            }
        }
        return redirect()->route('login'); // Chuyển hướng nếu không hợp lệ
    }
}
