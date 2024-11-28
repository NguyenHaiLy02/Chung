<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbChungNhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbchungnhan')->insert([
            // Nhà cung cấp 1 có 2 chứng nhận
            [
                'maNCC' => 1, 
                'hinhanh' => 'chungnhan_huu_co_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 1, 
                'hinhanh' => 'chungnhan_an_toan_thuc_pham_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 2 có 3 chứng nhận
            [
                'maNCC' => 2, 
                'hinhanh' => 'chungnhan_haccp_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 2, 
                'hinhanh' => 'chungnhan_iso22000_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 2, 
                'hinhanh' => 'chungnhan_globalgap_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 3 có 1 chứng nhận
            [
                'maNCC' => 3, 
                'hinhanh' => 'chungnhan_vietgap_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 4 có 2 chứng nhận
            [
                'maNCC' => 4, 
                'hinhanh' => 'chungnhan_thuc_pham_sach_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 4, 
                'hinhanh' => 'chungnhan_huu_co_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 5 có 1 chứng nhận
            [
                'maNCC' => 5, 
                'hinhanh' => 'chungnhan_organic_farming_5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
