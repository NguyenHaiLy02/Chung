<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbNhanVien extends Model
{
    use HasFactory;

    protected $table = 'tbnhanvien';
    protected $primaryKey = 'maNhanVien';

    protected $fillable = ['taiKhoan', 'hoTen', 'chucVu', 'ngaySinh', 'cccd', 'sdt', 'diachi'];

    public function taiKhoan()
    {
        return $this->belongsTo(TbTaiKhoan::class, 'taiKhoan', 'taiKhoan');
    }
}
