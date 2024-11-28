<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbGioHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbgiohang')->insert([
            [
                'taiKhoan' => "NguyenVanB02",
                'maSanPham' => 1,
                'soLuong' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => "NguyenVanB02",
                'maSanPham' => 2,
                'soLuong' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => "NguyenVanA01",
                'maSanPham' => 4,
                'soLuong' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => "NguyenVanA01",
                'maSanPham' => 2,
                'soLuong' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => "NguyenVanB02",
                'maSanPham' => 3,
                'soLuong' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
