<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbNhaCungCapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbnhacungcap')->insert([
            // Rau củ quả
            [
                'taiKhoan' => 'GreenOrganic',
                'tenNCC' => 'Green Organic',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0912345678',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 1, // Rau củ quả
            ],
            [
                'taiKhoan' => 'Vinmart',
                'tenNCC' => 'Vinmart+',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0987654321',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 1, // Rau củ quả
            ],

            // Thịt sống
            [
                'taiKhoan' => 'Sagrifood',
                'tenNCC' => 'Sagrifood',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0911234567',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 2, // Thịt sống
            ],
            [
                'taiKhoan' => 'FarmingVietnam',
                'tenNCC' => 'Farming Vietnam',
                'diaChi' => 'Hồ Chí Minh, Việt Nam',
                'sdt' => '0945456767',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 2, // Thịt sống
            ],

            // Hải sản
            [
                'taiKhoan' => 'FreshMart',
                'tenNCC' => 'Fresh Mart',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0933445566',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 3, // Hải sản
            ],
            [
                'taiKhoan' => 'FoodConnect',
                'tenNCC' => 'Food Connect',
                'diaChi' => 'Hồ Chí Minh, Việt Nam',
                'sdt' => '0902123344',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 3, // Hải sản
            ],

            // Trái cây tươi
            [
                'taiKhoan' => 'CauBac',
                'tenNCC' => 'Cầu Bắc',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0977888999',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 4, // Trái cây tươi
            ],
            [
                'taiKhoan' => 'FruitsGarden',
                'tenNCC' => 'Fruits Garden',
                'diaChi' => 'Hồ Chí Minh, Việt Nam',
                'sdt' => '0922334455',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 4, // Trái cây tươi
            ],

            // Ngũ cốc và hạt
            [
                'taiKhoan' => 'GreenFields',
                'tenNCC' => 'Green Fields',
                'diaChi' => 'Bắc Giang, Việt Nam',
                'sdt' => '0902123456',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 5, // Ngũ cốc và hạt
            ],
            [
                'taiKhoan' => 'RiceWorld',
                'tenNCC' => 'Rice World',
                'diaChi' => 'Hồ Chí Minh, Việt Nam',
                'sdt' => '0932323232',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 5, // Ngũ cốc và hạt
            ],

            // Gia vị và thảo mộc
            [
                'taiKhoan' => 'SpicesHouse',
                'tenNCC' => 'Spices House',
                'diaChi' => 'Hồ Chí Minh, Việt Nam',
                'sdt' => '0987654321',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 6, // Gia vị và thảo mộc
            ],
            [
                'taiKhoan' => 'HerbGarden',
                'tenNCC' => 'Herb Garden',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0912345678',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 6, // Gia vị và thảo mộc
            ],

            // Sữa và các sản phẩm từ sữa
            [
                'taiKhoan' => 'DairyFresh',
                'tenNCC' => 'Dairy Fresh',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0911223344',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 7, // Sữa và các sản phẩm từ sữa
            ],
            [
                'taiKhoan' => 'MilkHouse',
                'tenNCC' => 'Milk House',
                'diaChi' => 'Đà Nẵng, Việt Nam',
                'sdt' => '0982334455',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 7, // Sữa và các sản phẩm từ sữa
            ],

            // Bánh kẹo và đồ ăn vặt
            [
                'taiKhoan' => 'SnackWorld',
                'tenNCC' => 'Snack World',
                'diaChi' => 'Hồ Chí Minh, Việt Nam',
                'sdt' => '0901011122',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 8, // Bánh kẹo và đồ ăn vặt
            ],
            [
                'taiKhoan' => 'HealthyTreats',
                'tenNCC' => 'Healthy Treats',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0922334455',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 8, // Bánh kẹo và đồ ăn vặt
            ],

            // Đồ uống
            [
                'taiKhoan' => 'VietBeverage',
                'tenNCC' => 'Viet Beverage',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0945678901',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 9, // Đồ uống
            ],
            [
                'taiKhoan' => 'DrinkShop',
                'tenNCC' => 'Drink Shop',
                'diaChi' => 'Đà Nẵng, Việt Nam',
                'sdt' => '0908765432',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 9, // Đồ uống
            ],

            // Dầu ăn và gia vị chế biến
            [
                'taiKhoan' => 'OilSupply',
                'tenNCC' => 'Oil Supply',
                'diaChi' => 'Hà Nội, Việt Nam',
                'sdt' => '0902123444',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 10, // Dầu ăn và gia vị chế biến
            ],
            [
                'taiKhoan' => 'HerbOil',
                'tenNCC' => 'Herb Oil',
                'diaChi' => 'Đà Nẵng, Việt Nam',
                'sdt' => '0922334455',
                'xuatXu' => 'Việt Nam',
                'maDanhMuc' => 10, // Dầu ăn và gia vị chế biến
            ],

            // Mì, phở và thực phẩm chế biến sẵn
            // [
            //     'taiKhoan' => 'InstantFoodCo',
            //     'tenNCC' => 'Instant Food Co.',
            //     'diaChi' => 'Hà Nội, Việt Nam',
            //     'sdt' => '0901234567',
            //     'xuatXu' => 'Việt Nam',
            //     'maDanhMuc' => 11, // Mì, phở và thực phẩm chế biến sẵn
            // ],
            // [
            //     'taiKhoan' => 'QuickMealSupply',
            //     'tenNCC' => 'Quick Meal Supply',
            //     'diaChi' => 'Hồ Chí Minh, Việt Nam',
            //     'sdt' => '0913445678',
            //     'xuatXu' => 'Việt Nam',
            //     'maDanhMuc' => 11, // Mì, phở và thực phẩm chế biến sẵn
            // ]
        ]);
    }
}
