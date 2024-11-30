<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
class TbHinhAnhSpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbhinhanhsp')->insert([
            [
                'maSanPham' => 1, // Cà chua đỏ
                'hinhAnh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQG0jPYWrFFJI1q8cqyKSXsPnXHpxkl5GkYAg&s',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 1, // Cà chua đỏ
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 2, // Cải bó xôi
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 3, // Rau mùi
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 4, // Thịt bò tươi
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 4, // Thịt bò tươi (hình thứ 2)
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 5, // Thịt heo ba chỉ
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 6, // Tôm tươi
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 7, // Cá hồi tươi
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 8, // Táo đỏ
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 9, // Chuối tiêu
                'hinhAnh' =>'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 10, // Gạo tẻ
                'hinhAnh' => 'https://png.pngtree.com/background/20220718/original/pngtree-children-s-thick-cut-lettuce-steak-picture-image_1665751.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
