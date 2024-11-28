<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbsanpham')->insert([
            // Danh mục Rau củ quả
            [
                'tenSanPham' => 'Cà chua đỏ',
                'moTa' => 'Cà chua đỏ tươi ngon, giàu vitamin C, giúp tăng cường hệ miễn dịch.',
                'cachBaoQuan' => 'Bảo quản ở nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp.',
                'giaTien' => 15000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-15',
                'ngayHetHan' => '2024-12-02',
                'soLuongTonKho' => 500,
                'maNCC' => 1, // Green Organic
                'maDanhMuc' => 1, // Rau củ quả
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenSanPham' => 'Cải bó xôi',
                'moTa' => 'Cải bó xôi tươi, giàu chất xơ và vitamin K, rất tốt cho sức khỏe.',
                'cachBaoQuan' => 'Bảo quản trong tủ lạnh, dùng trong vòng 3 ngày.',
                'giaTien' => 12000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-20',
                'ngayHetHan' => '2024-12-03',
                'soLuongTonKho' => 300,
                'maNCC' => 2, // Vinmart+
                'maDanhMuc' => 1, // Rau củ quả
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenSanPham' => 'Rau mùi',
                'moTa' => 'Rau mùi tươi, thơm mát, thường dùng làm gia vị trong các món ăn.',
                'cachBaoQuan' => 'Bảo quản trong tủ lạnh, dùng trong vòng 3 ngày.',
                'giaTien' => 8000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-23',
                'ngayHetHan' => '2024-11-30',
                'soLuongTonKho' => 400,
                'maNCC' => 3, // Fresh Farm
                'maDanhMuc' => 1, // Rau củ quả
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Danh mục Thịt sống
            [
                'tenSanPham' => 'Thịt bò tươi',
                'moTa' => 'Thịt bò tươi, chất lượng cao, thích hợp cho các món nướng, xào, hầm.',
                'cachBaoQuan' => 'Bảo quản trong ngăn đông tủ lạnh, sử dụng trong vòng 3 ngày.',
                'giaTien' => 250000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-23',
                'ngayHetHan' => '2024-11-30',
                'soLuongTonKho' => 200,
                'maNCC' => 4, // Sagrifood
                'maDanhMuc' => 2, // Thịt sống
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenSanPham' => 'Thịt heo ba chỉ',
                'moTa' => 'Thịt heo ba chỉ mỏng, mềm, thích hợp cho món luộc, nướng, kho.',
                'cachBaoQuan' => 'Bảo quản trong ngăn đông tủ lạnh, sử dụng trong vòng 5 ngày.',
                'giaTien' => 200000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-24',
                'ngayHetHan' => '2024-12-01',
                'soLuongTonKho' => 150,
                'maNCC' => 5, // Farming Vietnam
                'maDanhMuc' => 2, // Thịt sống
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Danh mục Hải sản
            [
                'tenSanPham' => 'Tôm tươi',
                'moTa' => 'Tôm tươi, ngon ngọt, giàu protein, thích hợp cho các món xào, canh.',
                'cachBaoQuan' => 'Bảo quản trong ngăn đông tủ lạnh, dùng trong vòng 1 tuần.',
                'giaTien' => 300000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-22',
                'ngayHetHan' => '2024-12-02',
                'soLuongTonKho' => 100,
                'maNCC' => 6, // FreshMart
                'maDanhMuc' => 3, // Hải sản
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenSanPham' => 'Cá hồi tươi',
                'moTa' => 'Cá hồi tươi, giàu Omega 3, rất tốt cho tim mạch và sức khỏe.',
                'cachBaoQuan' => 'Bảo quản trong ngăn đông tủ lạnh, sử dụng trong vòng 5 ngày.',
                'giaTien' => 350000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-21',
                'ngayHetHan' => '2024-11-28',
                'soLuongTonKho' => 50,
                'maNCC' => 7, // FoodConnect
                'maDanhMuc' => 3, // Hải sản
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Danh mục Trái cây tươi
            [
                'tenSanPham' => 'Táo đỏ',
                'moTa' => 'Táo đỏ tươi, giòn, ngọt, giàu vitamin C và chất xơ.',
                'cachBaoQuan' => 'Bảo quản ở nơi mát mẻ, tránh ánh nắng trực tiếp.',
                'giaTien' => 18000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-23',
                'ngayHetHan' => '2024-12-02',
                'soLuongTonKho' => 400,
                'maNCC' => 8, // CauBac
                'maDanhMuc' => 4, // Trái cây tươi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenSanPham' => 'Chuối tiêu',
                'moTa' => 'Chuối tiêu vàng, ngọt mát, giàu kali, giúp tăng cường sức khỏe tim mạch.',
                'cachBaoQuan' => 'Bảo quản ở nơi thoáng mát, tránh ánh nắng trực tiếp.',
                'giaTien' => 15000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-24',
                'ngayHetHan' => '2024-12-04',
                'soLuongTonKho' => 350,
                'maNCC' => 9, // FruitsGarden
                'maDanhMuc' => 4, // Trái cây tươi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Danh mục Ngũ cốc và hạt
            [
                'tenSanPham' => 'Gạo tẻ',
                'moTa' => 'Gạo tẻ sạch, được thu hoạch từ những cánh đồng hữu cơ, không sử dụng hóa chất.',
                'cachBaoQuan' => 'Bảo quản nơi khô ráo, thoáng mát.',
                'giaTien' => 25000.00,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-11-17',
                'ngayHetHan' => '2025-11-16',
                'soLuongTonKho' => 500,
                'maNCC' => 10, // OrganicWheat
                'maDanhMuc' => 5, // Ngũ cốc và hạt
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenSanPham' => 'Hạt chia',
                'moTa' => 'Hạt chia nhập khẩu, giàu Omega 3, rất tốt cho sức khỏe.',
                'cachBaoQuan' => 'Bảo quản nơi khô ráo, thoáng mát.',
                'giaTien' => 300000.00,
                'donViTinh' => 'gói 500g',
                'ngaySanXuat' => '2024-11-10',
                'ngayHetHan' => '2025-11-09',
                'soLuongTonKho' => 200,
                'maNCC' => 11, // HealthyChoice
                'maDanhMuc' => 5, // Ngũ cốc và hạt
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
