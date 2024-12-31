<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbChiTietYeuCauNhapHang extends Model
{
    use HasFactory;

    // Đặt tên bảng
    protected $table = 'tbchitietyeucaunhaphang';
    protected $primaryKey = 'maChiTietYeuCau';
    // Các trường có thể gán giá trị
    protected $fillable = [
        'maYeuCau',
        'maTin',
        'soLuongYeuCau',
        'giaTien'
    ];

    // Quan hệ với bảng TbYeuCauNhapHang (nhiều chi tiết yêu cầu thuộc về một yêu cầu nhập hàng)
    public function yeuCauNhapHang()
    {
        return $this->belongsTo(TbYeuCauNhapHang::class, 'maYeuCau');
    }

    // Quan hệ với bảng TbTinDangSanPham (nhiều chi tiết yêu cầu thuộc về một tin đăng sản phẩm)
    public function tinDangSanPham()
    {
        return $this->belongsTo(TbTinDangSanPham::class, 'maTin');
    }
}
