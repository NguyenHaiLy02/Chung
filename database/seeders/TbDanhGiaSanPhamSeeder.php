<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbDanhGiaSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbdanhgiasanpham')->insert([
            [
                'maChiTietDonHang' => 1, // Liên kết với tbChiTietDonHang
                'soLuongSao' => 5, // Đánh giá 5 sao
                'noiDung' => 'Sản phẩm rất tốt, giao hàng nhanh!',
            ],
            [
                'maChiTietDonHang' => 2,
                'soLuongSao' => 4,
                'noiDung' => 'Chất lượng sản phẩm ổn, nhưng giá hơi cao.',
            ],
            [
                'maChiTietDonHang' => 3,
                'soLuongSao' => 3,
                'noiDung' => 'Sản phẩm không như mong đợi, cần cải thiện.',
            ],
            [
                'maChiTietDonHang' => 4,
                'soLuongSao' => 5,
                'noiDung' => 'Mua lần thứ 2, rất hài lòng với chất lượng.',
            ],
            [
                'maChiTietDonHang' => 5,
                'soLuongSao' => 4,
                'noiDung' => 'Giao hàng nhanh, đóng gói cẩn thận.',
            ],
            [
                'maChiTietDonHang' => 6,
                'soLuongSao' => 2,
                'noiDung' => 'Hàng bị lỗi, cần đổi trả.',
            ],
            [
                'maChiTietDonHang' => 7,
                'soLuongSao' => 5,
                'noiDung' => 'Hàng chất lượng cao, giá cả hợp lý.',
            ],
            [
                'maChiTietDonHang' => 8,
                'soLuongSao' => 1,
                'noiDung' => 'Rất thất vọng, giao sai sản phẩm.',
            ],
        ]);
    }
}
