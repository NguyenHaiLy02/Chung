<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbDonHang extends Model
{
    use HasFactory;

    protected $table = 'tbdonhang';
    protected $fillable = ['taiKhoan', 'ngayDatHang', 'tongTien', 'trangThaiDonHang', 'diaChiGiaoHang','sdt', 'trangThaiThanhToan', 'maNhanVienGiaoHang', 'maNhanVienDuyet'];

    public function taiKhoan()
    {
        return $this->belongsTo(TbTaiKhoan::class, 'taiKhoan');
    }

    public function nhanVienGiaoHang()
    {
        return $this->belongsTo(TbNhanVien::class, 'maNhanVienGiaoHang');
    }

    public function nhanVienDuyet()
    {
        return $this->belongsTo(TbNhanVien::class, 'maNhanVienDuyet');
    }
}
