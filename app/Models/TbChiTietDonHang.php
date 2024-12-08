<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbChiTietDonHang extends Model
{
    use HasFactory;

    protected $table = 'tbchitietdonhang';
    protected $primaryKey = 'maChiTietDonHang';
    protected $fillable = ['maDonHang', 'maSanPham', 'soLuong', 'donGia'];

    public function donHang()
    {
        return $this->belongsTo(TbDonHang::class, 'maDonHang');
    }

    public function sanPham()
    {
        return $this->belongsTo(TbSanPham::class, 'maSanPham');
    }
    public function danhGiaSanPhams()
    {
        return $this->hasMany(DanhGiaSanPham::class, 'maChiTietDonHang', 'maChiTietDonHang');
    }

}
