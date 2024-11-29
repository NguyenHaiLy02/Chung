<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbGioHang extends Model
{
    use HasFactory;

    protected $table = 'tbgiohang';
    protected $fillable = ['taiKhoan', 'maSanPham', 'soLuong'];

    public $incrementing = false; // Không tự động tăng vì dùng composite key

    public function taiKhoan()
    {
        return $this->belongsTo(TbTaiKhoan::class, 'taiKhoan');
    }

    public function sanPham()
    {
        return $this->belongsTo(TbSanPham::class, 'maSanPham');
    }
}
