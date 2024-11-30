<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbTaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbtaikhoan')->insert([
            [
                'taiKhoan' => 'ChucuahangDaNa',
                'quyen' => 'chucuahang',  // Quyền chủ cửa hàng
                'matKhau' => bcrypt('Abc12345'),  // Mã hóa mật khẩu
                'email' => 'danamart@gmail.com',
                'verify_email' => true,
            ],
            [
                'taiKhoan' => 'user1',
                'quyen' => 'nhanvien',  // Quyền nhân viên
                'matKhau' => bcrypt('Abc12345'),
                'email' => 'user1@gmail.com',
                'verify_email' => true,
            ],
            [
                'taiKhoan' => 'user2',
                'quyen' => 'nhanviengiaohang',  // Quyền nhân viên giao hàng
                'matKhau' => bcrypt('Abc12345'),
                'email' => 'user2@gmail.com',
                'verify_email' => true,
            ],
            [
                'taiKhoan' => 'NguyenVanA01',
                'quyen' => 'khachhang',  // Quyền khách hàng
                'matKhau' => bcrypt('Abc12345'),
                'email' => 'nguyenvana@gmail.com',
                'verify_email' => true,
            ],
            [
                'taiKhoan' => 'NguyenVanB02',
                'quyen' => 'khachhang',  // Quyền khách hàng
                'matKhau' => bcrypt('Abc12345'),
                'email' => 'nguyenvanb@gmail.com',
                'verify_email' => true,
            ],
            ['taiKhoan' => 'GreenOrganic', 'quyen' => 'nhacungcap', 'matKhau' => 'Green1234', 'email' => 'greenorganic@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'Vinmart', 'quyen' => 'nhacungcap', 'matKhau' => 'Vinmart123', 'email' => 'vinmart@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'Sagrifood', 'quyen' => 'nhacungcap', 'matKhau' => 'Sagrifood123', 'email' => 'sagrifood@gmail.com','verify_email' => true],
            ['taiKhoan' => 'FarmingVietnam', 'quyen' => 'nhacungcap', 'matKhau' => 'Farming123', 'email' => 'farmingvietnam@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'FreshMart', 'quyen' => 'nhacungcap', 'matKhau' => 'Fresh1234', 'email' => 'freshmart@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'FoodConnect', 'quyen' => 'nhacungcap', 'matKhau' => 'Food1234', 'email' => 'foodconnect@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'CauBac', 'quyen' => 'nhacungcap', 'matKhau' => 'CauBac123', 'email' => 'caubac@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'FruitsGarden', 'quyen' => 'nhacungcap', 'matKhau' => 'Fruits123', 'email' => 'fruitsgarden@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'GreenFields', 'quyen' => 'nhacungcap', 'matKhau' => 'Fields123', 'email' => 'greenfields@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'RiceWorld', 'quyen' => 'nhacungcap', 'matKhau' => 'Rice1234', 'email' => 'riceworld@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'SpicesHouse', 'quyen' => 'nhacungcap', 'matKhau' => 'Spices123', 'email' => 'spiceshouse@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'HerbGarden', 'quyen' => 'nhacungcap', 'matKhau' => 'Herb1234', 'email' => 'herbgarden@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'DairyFresh', 'quyen' => 'nhacungcap', 'matKhau' => 'Dairy1234', 'email' => 'dairyfresh@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'MilkHouse', 'quyen' => 'nhacungcap', 'matKhau' => 'Milk1234', 'email' => 'milkhouse@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'SnackWorld', 'quyen' => 'nhacungcap', 'matKhau' => 'Snack1234', 'email' => 'snackworld@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'HealthyTreats', 'quyen' => 'nhacungcap', 'matKhau' => 'Healthy123', 'email' => 'healthytreats@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'VietBeverage', 'quyen' => 'nhacungcap', 'matKhau' => 'Viet1234', 'email' => 'vietbeverage@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'DrinkShop', 'quyen' => 'nhacungcap', 'matKhau' => 'Drink1234', 'email' => 'drinkshop@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'OilSupply', 'quyen' => 'nhacungcap', 'matKhau' => 'Oil1234', 'email' => 'oilsupply@gmail.com','verify_email' => true,],
            ['taiKhoan' => 'HerbOil', 'quyen' => 'nhacungcap', 'matKhau' => 'HerbOil123', 'email' => 'herboil@gmail.com','verify_email' => true,],
            
            [
                'taiKhoan' => 'VinmartPlus',
                'quyen' => 'nhacungcap',  // Quyền nhà cung cấp
                'matKhau' => bcrypt('Abc12345'),
                'email' => 'vinmartplus@gmail.com',
                'verify_email' => true,
            ],
        ]);
    }
}
