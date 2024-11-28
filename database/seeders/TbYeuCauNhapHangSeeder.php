<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbYeuCauNhapHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbyeucaunhaphang')->insert([
            [
                'maTin' => 1,
                'soLuongYeuCau' => 50,
                'giaTien' => 2000000.00,
                'trangThai' => 'Đang chờ duyệt',
                'trangThaiThanhToan' => 'Chưa thanh toán',
                'ngayNhanDuKien' => '2024-12-05',
                'ngayNhanThucTe' => null,
                'maNhanVien' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 2,
                'soLuongYeuCau' => 100,
                'giaTien' => 15000000.00,
                'trangThai' => 'Đã duyệt',
                'trangThaiThanhToan' => 'Đã thanh toán',
                'ngayNhanDuKien' => '2024-11-30',
                'ngayNhanThucTe' => '2024-11-29',
                'maNhanVien' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 3,
                'soLuongYeuCau' => 200,
                'giaTien' => 30000000.00,
                'trangThai' => 'Đã hủy',
                'trangThaiThanhToan' => 'Hoàn tiền',
                'ngayNhanDuKien' => '2024-12-10',
                'ngayNhanThucTe' => null,
                'maNhanVien' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
