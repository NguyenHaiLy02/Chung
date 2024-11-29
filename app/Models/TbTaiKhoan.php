<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TbTaiKhoan extends Authenticatable
{
    use HasFactory;

    protected $table = 'tbtaikhoan';
    protected $primaryKey = 'taiKhoan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['taiKhoan', 'quyen', 'matKhau', 'email'];

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
}

