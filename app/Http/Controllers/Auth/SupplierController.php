<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TbTaiKhoan;
use App\Models\TbNhaCungCap;
use App\Models\TbChungNhan;
use App\Models\TbDanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class SupplierController extends Controller
{
    public function showForm()
    {
        $danhmucs = TbDanhMuc::all(); // Lấy tất cả danh mục để hiển thị trong form
        return view('auth.register-supplier', compact('danhmucs'));
    }

    public function register(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'taiKhoan' => 'required|unique:tbtaikhoan,taiKhoan',
            'email' => 'required|email|unique:tbtaikhoan,email',
            'matKhau' => 'required|min:6',
            'tenNCC' => 'required',
            'diaChi' => 'required',
            'sdt' => 'required',
            'xuatXu' => 'required',
            'maDanhMuc' => 'required|exists:tbdanhmuc,maDanhMuc',
            'hinhanh' => 'required|array|min:1', // Yêu cầu ít nhất 1 hình ảnh
            'hinhanh.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Kiểm tra từng tệp là hình ảnh
        ]);

        // Insert vào bảng tbtaikhoan
        $user = TbTaiKhoan::create([
            'taiKhoan' => $validated['taiKhoan'],
            'quyen' => 'nhacungcap',
            'matKhau' => bcrypt($validated['matKhau']),
            'email' => $validated['email'],
        ]);

        // Insert vào bảng tbnhacungcap
        $ncc = TbNhaCungCap::create([
            'taiKhoan' => $validated['taiKhoan'],
            'tenNCC' => $validated['tenNCC'],
            'diaChi' => $validated['diaChi'],
            'sdt' => $validated['sdt'],
            'xuatXu' => $validated['xuatXu'],
            'maDanhMuc' => $validated['maDanhMuc'],
        ]);

        // Insert vào bảng tbchungnhan (lưu nhiều hình ảnh)
        if ($request->hasFile('hinhanh')) {
            foreach ($request->file('hinhanh') as $file) {
                $path = $file->store('public/chungnhan');
                // Lưu vào bảng tbchungnhan
                TbChungNhan::create([
                    'maNCC' => $ncc->maNCC,
                    'hinhanh' => $path, // Đảm bảo đường dẫn của hình ảnh được lưu vào bảng
                ]);
            }
        }        
        event(new Registered($user));
        // Redirect với thông báo thành công
        return redirect()->route('supplier.form')->with('success', 'Đơn đăng ký đã được gửi, vui lòng xác thực email để hoàn tất quá trình!');
    }
}
