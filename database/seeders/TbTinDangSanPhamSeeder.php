<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbTinDangSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbtindangsanpham')->insert([
            [
                'maNCC' => 1,
                'tenSP' => 'Gạo ST25',
                'moTa' => 'Gạo thơm hảo hạng, chất lượng xuất khẩu',
                'giaSP' => 20000,
                'donViTinh' => 'kg',
                'ngaySanXuat' => '2024-01-01 00:00:00',
                'ngayHetHan' => '2024-12-31 23:59:59',
                'soLuong' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 2,
                'tenSP' => 'Cà phê nguyên chất',
                'moTa' => 'Cà phê Arabica 100%, rang mộc, thơm ngon',
                'giaSP' => 150000,
                'donViTinh' => 'hộp',
                'ngaySanXuat' => '2023-12-15 00:00:00',
                'ngayHetHan' => '2025-12-15 23:59:59',
                'soLuong' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 3,
                'tenSP' => 'Trái cây sấy',
                'moTa' => 'Sản phẩm tự nhiên, không phẩm màu',
                'giaSP' => 120000,
                'donViTinh' => 'gói',
                'ngaySanXuat' => '2024-03-01 00:00:00',
                'ngayHetHan' => '2025-03-01 23:59:59',
                'soLuong' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 4,
                'tenSP' => 'Mật ong rừng',
                'moTa' => 'Mật ong nguyên chất từ rừng tự nhiên',
                'giaSP' => 250000,
                'donViTinh' => 'chai',
                'ngaySanXuat' => '2024-02-01 00:00:00',
                'ngayHetHan' => '2026-02-01 23:59:59',
                'soLuong' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maNCC' => 5,
                'tenSP' => 'Dầu oliu nguyên chất',
                'moTa' => 'Dầu oliu nhập khẩu từ Ý, nguyên chất 100%',
                'giaSP' => 300000,
                'donViTinh' => 'chai',
                'ngaySanXuat' => '2024-04-01 00:00:00',
                'ngayHetHan' => '2026-04-01 23:59:59',
                'soLuong' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
