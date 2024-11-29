<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbSanPham extends Model
{
    use HasFactory;

    protected $table = 'tbsanpham';
    protected $primaryKey = 'maSanPham';

    protected $fillable = [
        'tenSanPham', 'moTa', 'cachBaoQuan', 'giaTien', 'donViTinh',
        'ngaySanXuat', 'ngayHetHan', 'soLuongTonKho', 'maNCC', 'maDanhMuc'
    ];

    public function nhaCungCap()
    {
        return $this->belongsTo(TbNhaCungCap::class, 'maNCC', 'maNCC');
    }

    public function danhMuc()
    {
        return $this->belongsTo(TbDanhMuc::class, 'maDanhMuc', 'maDanhMuc');
    }

    public function hinhAnhSps()
    {
        return $this->hasMany(TbHinhAnhSp::class, 'maSanPham', 'maSanPham');
    }
}
