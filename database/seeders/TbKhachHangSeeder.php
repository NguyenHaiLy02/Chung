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
                'sdt' => '0987654321',
                'diaChi' => '48 Cao Thăng,Thanh Bình, Hải Châu, Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => 'NguyenVanB02',
                'sdt' => '0123456789',
                'diaChi' => '22 Ông Ích Khiêm, Thanh Bình, Hải Châu, Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
