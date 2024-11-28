<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbNhanVienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbnhanvien')->insert([
            [
                'taiKhoan' => 'ChucuahangDaNa',
                'hoTen' => 'Nguyễn Văn A',
                'chucVu' => 'Chủ cửa hàng',
                'ngaySinh' => '1985-06-15',
                'cccd' => '123456789012',
                'sdt' => '0901234567',
                'diachi' => '123 Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => 'user1',
                'hoTen' => 'Trần Thị B',
                'chucVu' => 'Nhân viên bán hàng',
                'ngaySinh' => '1990-02-20',
                'cccd' => '223456789012',
                'sdt' => '0902234567',
                'diachi' => '456 Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'taiKhoan' => 'user2',
                'hoTen' => 'Lê Văn C',
                'chucVu' => 'Nhân viên giao hàng',
                'ngaySinh' => '1995-10-05',
                'cccd' => '323456789012',
                'sdt' => '0903234567',
                'diachi' => '789 Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
