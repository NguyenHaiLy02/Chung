<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbHinhAnhTinDang extends Model
{
    use HasFactory;

    protected $table = 'tbhinhanhtindang';
    protected $fillable = ['maTin', 'hinhAnh'];

    public function tinDangSanPham()
    {
        return $this->belongsTo(TbTinDangSanPham::class, 'maTin');
    }
}
