<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbYeuCauNhapHang extends Model
{
    use HasFactory;

    // Đặt tên bảng
    protected $table = 'tbyeucaunhaphang';
    protected $primaryKey = 'maYeuCau';
    // Các trường có thể gán giá trị
    protected $fillable = [
        'trangThaiYeuCau',
        'trangThaiThanhToan',
        'tongTien',
        'ngayNhanDuKien',
        'ngayNhanThucTe',
        'maNhanVien'
    ];

    // Quan hệ với bảng TbNhanVien (nhiều yêu cầu nhập hàng thuộc một nhân viên)
    public function nhanVien()
    {
        return $this->belongsTo(TbNhanVien::class, 'maNhanVien');
    }

    public function chiTietYeuCau()
{
    return $this->hasMany(TbChiTietYeuCauNhapHang::class, 'maYeuCau');
}

}
