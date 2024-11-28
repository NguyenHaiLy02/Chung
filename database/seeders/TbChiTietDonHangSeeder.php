<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbChiTietDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbchitietdonhang')->insert([
            [
                'maDonHang' => 1,
                'maSanPham' => 3,
                'soLuong' => 2,
                'donGia' => 200000,
            ],
            [
                'maDonHang' => 1,
                'maSanPham' => 5,
                'soLuong' => 5,
                'donGia' => 50000,
            ],
            [
                'maDonHang' => 2,
                'maSanPham' => 7,
                'soLuong' => 1,
                'donGia' => 150000,
            ],
            [
                'maDonHang' => 2,
                'maSanPham' => 9,
                'soLuong' => 3,
                'donGia' => 80000,
            ],
            [
                'maDonHang' => 3,
                'maSanPham' => 1,
                'soLuong' => 10,
                'donGia' => 15000,
            ],
            [
                'maDonHang' => 3,
                'maSanPham' => 6,
                'soLuong' => 2,
                'donGia' => 70000,
            ],
            [
                'maDonHang' => 4,
                'maSanPham' => 8,
                'soLuong' => 1,
                'donGia' => 120000,
            ],
            [
                'maDonHang' => 4,
                'maSanPham' => 4,
                'soLuong' => 4,
                'donGia' => 300000,
            ],
        ]);
    }
}
