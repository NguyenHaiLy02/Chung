<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class TbTaiKhoan extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'tbtaikhoan';
    protected $primaryKey = 'taiKhoan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['taiKhoan', 'quyen', 'matKhau', 'email', 'verify_email'];

    // Quan hệ với các bảng khác
    public function khachHang()
    {
        return $this->hasOne(TbKhachHang::class, 'taiKhoan', 'taiKhoan');
    }

    public function nhanVien()
    {
        return $this->hasOne(TbNhanVien::class, 'taiKhoan', 'taiKhoan');
    }

    public function nhaCungCap()
    {
        return $this->hasOne(TbNhaCungCap::class, 'taiKhoan', 'taiKhoan');
    }

    // Phương thức trả về mật khẩu của người dùng (sử dụng cho việc xác thực)
    public function getAuthPassword()
    {
        return $this->matKhau;
    }

    // Phương thức xác thực email
    public function hasVerifiedEmail()
    {
        return $this->verify_email;
    }

    // Xử lý xác nhận email
    public function markEmailAsVerified()
    {
        $this->verify_email = true;
        $this->save();
    }
}
