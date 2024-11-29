<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbDanhMuc extends Model
{
    use HasFactory;

    protected $table = 'tbdanhmuc';
    protected $primaryKey = 'maDanhMuc';

    protected $fillable = ['tenDanhMuc', 'moTa'];

    public function sanPhams()
    {
        return $this->hasMany(TbSanPham::class, 'maDanhMuc', 'maDanhMuc');
    }

    public function nhaCungCaps()
    {
        return $this->hasMany(TbNhaCungCap::class, 'maDanhMuc', 'maDanhMuc');
    }
}
