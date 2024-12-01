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
                'hinhanh' => 'https://gaosachonline.com/wp-content/uploads/2020/06/gao-st25-768x768.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 1,
                'hinhanh' => 'https://gaosachonline.com/wp-content/uploads/2020/06/gao-st25-768x768.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 2,
                'hinhanh' => 'https://down-vn.img.susercontent.com/file/vn-11134258-7ras8-m35bdplluaj25f',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 2,
                'hinhanh' => 'https://namthong.vn/wp-content/uploads/2022/08/cac_loai_cafe_goi_ngon_hinh_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 3,
                'hinhanh' => 'https://suckhoedoisong.qltns.mediacdn.vn/thumb_w/1200/324455921873985536/2021/7/22/avatar1626924648875-1626924649695673618407.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 4,
                'hinhanh' => 'https://static.skyshoptv.vn/cache/catalog/san-pham-anh-khiem/bonie-bee/mat-ong-chin-to-dong-trung-gung-nghe-say/bonie-bee-dong-trung-ha-thao-mat-ong-chin-to-1000x1000.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 4,
                'hinhanh' => 'https://static.skyshoptv.vn/cache/catalog/san-pham-anh-khiem/bonie-bee/mat-ong-chin-to-dong-trung-gung-nghe-say/mat-ong-bonie-bee-1-1000x1000.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maTin' => 5,
                'hinhanh' => 'https://www.calofic.com.vn/wp-content/uploads/2020/06/Olivoila-Pomace-750ml_mockup_Spain-2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
