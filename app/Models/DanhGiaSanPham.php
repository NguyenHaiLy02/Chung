<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGiaSanPham extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không sử dụng tên bảng mặc định
    protected $table = 'tbdanhgiasanpham';

    // Đặt khóa chính nếu không phải là 'id'
    protected $primaryKey = 'maDanhGia';

    // Đặt các trường có thể gán hàng loạt (Mass Assignment)
    protected $fillable = [
        'maChiTietDonHang',
        'soLuongSao',
        'noiDung',
    ];

    // Đặt kiểu dữ liệu của khóa chính (nếu cần)
    protected $keyType = 'int';

    // Đặt các thuộc tính để không tự động tạo trường timestamps nếu không cần
    public $timestamps = true;

    // Quan hệ với bảng ChiTietDonHang (nếu có)
    public function chiTietDonHang()
    {
        return $this->belongsTo(ChiTietDonHang::class, 'maChiTietDonHang', 'maChiTietDonHang');
    }
}
