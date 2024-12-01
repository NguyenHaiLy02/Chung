<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbKhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbkhachhang')->insert([
            [
                'taiKhoan' => 'NguyenVanA01',
                'tenTaiKhoan' => 'Nguyễn Văn A',
                'anhDaiDien' => 'https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474082kTK/avatar-vit-trang-hai-huoc_044341897.png',
                'sdt' => '0987654321',
                'diaChi' => '48 Cao Thăng,Thanh Bình, Hải Châu, Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => 'NguyenVanB02',
                'tenTaiKhoan' => 'Nguyễn Văn B',
                'anhDaiDien' => 'https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474082mdK/avatar-vit-boi-roi-bua_044341327.jpg',
                'sdt' => '0123456789',
                'diaChi' => '22 Ông Ích Khiêm, Thanh Bình, Hải Châu, Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
