<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            TbTaiKhoanSeeder::class,
            TbKhachHangSeeder::class,
            TbNhanVienSeeder::class,
            TbDanhMucSeeder::class,
            TbNhaCungCapSeeder::class,
            TbSanPhamSeeder::class,
            TbHinhAnhSpSeeder::class,
            TbDonHangSeeder::class,
            TbChiTietDonHangSeeder::class,
            TbChungNhanSeeder::class,
            TbTinDangSanPhamSeeder::class,
            TbHinhAnhTinDangSeeder::class,
            TbYeuCauNhapHangSeeder::class,
            TbGioHangSeeder::class,
        ]);
    }
}
