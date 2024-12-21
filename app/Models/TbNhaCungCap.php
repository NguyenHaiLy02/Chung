<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbNhaCungCap extends Model
{
    use HasFactory;

    protected $table = 'tbnhacungcap';
    protected $primaryKey = 'maNCC';

    protected $fillable = ['taiKhoan', 'tenNCC', 'diaChi', 'sdt', 'xuatXu','pheDuyet', 'maDanhMuc'];

    public function taiKhoan()
    {
        return $this->belongsTo(TbTaiKhoan::class, 'taiKhoan', 'taiKhoan');
    }

    public function danhMuc()
    {
        return $this->belongsTo(TbDanhMuc::class, 'maDanhMuc', 'maDanhMuc');
    }

    public function sanPhams()
    {
        return $this->hasMany(TbSanPham::class, 'maNCC', 'maNCC');
    }
    public function chungNhans()
    {
        return $this->hasMany(TbChungNhan::class, 'maNCC', 'maNCC');
    }
}
