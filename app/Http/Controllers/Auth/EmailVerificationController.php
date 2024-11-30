<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Models\TbTaiKhoan;

class EmailVerificationController extends Controller
{
    /**
     * Xử lý xác thực email.
     */
    public function verify(Request $request, $id, $hash)
    {
        // Tìm người dùng theo ID
        $user = TbTaiKhoan::find($id);

        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            return redirect('/login')->withErrors('Không tìm thấy người dùng.');
        }

        // Kiểm tra nếu email đã được xác thực
        if ($user->verify_email) {
            return redirect('/login')->with('status', 'Email đã được xác thực!');
        }

        // Kiểm tra hash để xác nhận tính hợp lệ của liên kết
        if (!hash_equals($hash, sha1($user->email))) {
            return redirect('/login')->withErrors('Liên kết xác thực không hợp lệ.');
        }

        // Cập nhật trạng thái verify_email thành true
        $user->verify_email = true;
        $user->save();

        // Gửi sự kiện Verified (nếu cần thiết để tích hợp chức năng khác)
        event(new Verified($user));

        // Chuyển hướng sau khi xác thực thành công
        return redirect('/login')->with('status', 'Xác thực email thành công! Bây giờ bạn có thể đăng nhập.');
    }
}
