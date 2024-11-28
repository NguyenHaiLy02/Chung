<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbHinhAnhTinDangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbhinhanhtindang')->insert([
            [
                'maTin' => 1,
                'hinhanh' => 'images/gaost25_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 1,
                'hinhanh' => 'images/gaost25_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 2,
                'hinhanh' => 'images/caphe_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 2,
                'hinhanh' => 'images/caphe_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 3,
                'hinhanh' => 'images/traicay_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 4,
                'hinhanh' => 'images/matong_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 4,
                'hinhanh' => 'images/matong_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 5,
                'hinhanh' => 'images/dauoliu_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
