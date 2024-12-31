<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbTinDangSanPham extends Model
{
    use HasFactory;

    protected $table = 'tbtindangsanpham';
    protected $primaryKey = 'maTin';
    protected $fillable = ['maNCC', 'tenSP', 'moTa', 'giaSP', 'donViTinh', 'ngaySanXuat', 'ngayHetHan', 'soLuong'];

    public function nhaCungCap()
    {
        return $this->belongsTo(TbNhaCungCap::class, 'maNCC');
    }
    public function hinhanhtindang()
    {
        return $this->hasMany(TbHinhAnhTinDang::class, 'maTin', 'maTin');
    }
}
