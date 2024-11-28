<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbDanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbdanhmuc')->insert([
            ['tenDanhMuc' => 'Rau củ quả', 'moTa' => 'Các loại rau xanh, củ quả tươi sạch đạt chuẩn an toàn.'],
            ['tenDanhMuc' => 'Thịt sống', 'moTa' => 'Các loại thịt tươi như thịt heo, thịt bò, thịt gà.'],
            ['tenDanhMuc' => 'Hải sản', 'moTa' => 'Các loại cá, tôm, cua, ghẹ, và hải sản tươi sống khác.'],
            ['tenDanhMuc' => 'Trái cây tươi', 'moTa' => 'Các loại trái cây hữu cơ, giàu dinh dưỡng và an toàn.'],
            ['tenDanhMuc' => 'Ngũ cốc và hạt', 'moTa' => 'Ngũ cốc, các loại hạt giàu chất dinh dưỡng.'],
            ['tenDanhMuc' => 'Gia vị và thảo mộc', 'moTa' => 'Gia vị sạch, thảo mộc tự nhiên, không chất bảo quản.'],
            ['tenDanhMuc' => 'Sữa và các sản phẩm từ sữa', 'moTa' => 'Sữa, sữa chua, bơ, phô mai tươi sạch.'],
            ['tenDanhMuc' => 'Bánh kẹo và đồ ăn vặt', 'moTa' => 'Bánh kẹo hữu cơ, đồ ăn vặt từ rau củ, ít đường.'],
            ['tenDanhMuc' => 'Đồ uống', 'moTa' => 'Các loại nước ép trái cây, trà, sữa hạt tốt cho sức khỏe.'],
            ['tenDanhMuc' => 'Dầu ăn và gia vị chế biến', 'moTa' => 'Dầu thực vật sạch, nước tương, gia vị an toàn.'],
            ['tenDanhMuc' => 'Mì, phở và thực phẩm chế biến sẵn', 'moTa' => 'Mì sạch, bún gạo lứt, các sản phẩm chế biến sẵn.']
        ]);
    }
}
