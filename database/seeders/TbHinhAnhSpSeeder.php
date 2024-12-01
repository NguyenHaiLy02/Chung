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
                'hinhAnh' => 'https://napaco.vn/wp-content/uploads/2022/11/hop-nhua-dung-ca-chua-napaco-13-768x480.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 1, // Cà chua đỏ
                'hinhAnh' => 'https://napaco.vn/wp-content/uploads/2022/11/hop-nhua-dung-ca-chua-napaco-4.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 2, // Cải bó xôi
                'hinhAnh' => 'https://storage.googleapis.com/mm-online-bucket/ecommerce-website/uploads/media/194879.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 3, // Rau mùi
                'hinhAnh' => 'https://mgmartbd.com/wp-content/uploads/2020/10/unnamed7.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 4, // Thịt bò tươi
                'hinhAnh' => 'https://product.hstatic.net/1000301274/product/10100006_9_25a150c9505e4101a0c3b1bd2af3ba1f_grande.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 4, // Thịt bò tươi (hình thứ 2)
                'hinhAnh' => 'https://product.hstatic.net/1000301274/product/10100006_10_e56e320420d34384a2b45c1e7bff8c96_grande.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 5, // Thịt heo ba chỉ
                'hinhAnh' => 'https://thucphamnhanh.com/wp-content/uploads/2021/01/thit-heo-ba-chi-ba-roi-cp-1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 6, // Tôm tươi
                'hinhAnh' => 'http://tomtam.vn/wp-content/uploads/2016/01/sanpham_04-1-600x600.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 7, // Cá hồi tươi
                'hinhAnh' => 'https://product.hstatic.net/1000030244/product/cahoi-phile-than-1_55994516a344408f8bd6032c17a96fbe_grande.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 8, // Táo đỏ
                'hinhAnh' => 'https://newfreshfoods.com.vn//datafiles/3/2024-01-18/17055490692235_hop-qua-tao-envy-my-6-trai-3.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 9, // Chuối tiêu
                'hinhAnh' =>'https://bizweb.dktcdn.net/100/475/702/products/chuoi-tieu.png?v=1682103454700',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'maSanPham' => 10, // Gạo tẻ
                'hinhAnh' => 'https://down-vn.img.susercontent.com/file/0262135b2039249cb9f523e90be3c88f@resize_w900_nl.webp',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}