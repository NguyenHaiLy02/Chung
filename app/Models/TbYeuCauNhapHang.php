<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbYeuCauNhapHang extends Model
{
    use HasFactory;

    protected $table = 'tbyeucaunhaphang';
    protected $fillable = ['maTin', 'soLuongYeuCau', 'giaTien', 'trangThai', 'trangThaiThanhToan', 'ngayNhanDuKien', 'ngayNhanThucTe', 'maNhanVien'];

    public function tinDangSanPham()
    {
        return $this->belongsTo(TbTinDangSanPham::class, 'maTin');
    }

    public function nhanVien()
    {
        return $this->belongsTo(TbNhanVien::class, 'maNhanVien');
    }
}
