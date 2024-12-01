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
                'hinhanh' => 'https://tqc.vn/pic/Service/images/chung-chi-chung-nhan-huu-co-trong-trot-01-01-01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 1, 
                'hinhanh' => 'https://ketoananpha.vn/uploads/images/post/517-moi/quy-dinh-ve-giay-chung-nhan-an-toan-thuc-pham-02.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 2 có 3 chứng nhận
            [
                'maNCC' => 2, 
                'hinhanh' => 'https://chungnhaniso.org.vn/upload/elfinder/Iso9001/hinh%20giay%20cn%20Haccp.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 2, 
                'hinhanh' => 'https://isoq.vn/wp-content/uploads/2021/08/GCN-22K-1-724x1024.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 2, 
                'hinhanh' => 'https://tqc.vn/pic/Service/images/ACCREDITATION%20CERTIFICATE-CGLOBAL_GLOBALG_A_P_-01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 3 có 1 chứng nhận
            [
                'maNCC' => 3, 
                'hinhanh' => 'https://vinaucare.com/wp-content/uploads/2020/05/46fe481fbbe45dba04f5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 4 có 2 chứng nhận
            [
                'maNCC' => 4, 
                'hinhanh' => 'https://media.loveitopcdn.com/25/giay-vsattp.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 4, 
                'hinhanh' => 'https://tqc.vn/pic/Service/images/chung-chi-chung-nhan-huu-co-trong-trot-01-01-01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nhà cung cấp 5 có 1 chứng nhận
            [
                'maNCC' => 5, 
                'hinhanh' => 'https://accgroup.vn/wp-content/uploads/2023/02/chung-chi-huu-co-trieu-phong-vi-en-1.jpg.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}