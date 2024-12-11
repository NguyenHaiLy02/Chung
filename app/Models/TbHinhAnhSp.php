<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbHinhAnhSp extends Model
{
    use HasFactory;

    protected $table = 'tbhinhanhsp';
    protected $primaryKey = 'maHinhAnh';
    protected $fillable = ['maSanPham', 'hinhAnh'];

    public function sanPham()
    {
        return $this->belongsTo(TbSanPham::class, 'maSanPham');
    }
}
