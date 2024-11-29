<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbKhachHang extends Model
{
    use HasFactory;

    protected $table = 'tbkhachhang';
    protected $primaryKey = 'maKhachHang';

    protected $fillable = ['taiKhoan', 'sdt', 'diaChi'];

    public function taiKhoan()
    {
        return $this->belongsTo(TbTaiKhoan::class, 'taiKhoan', 'taiKhoan');
    }
}
