<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TbDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbdonhang')->insert([
            [
                'taiKhoan' => 'NguyenVanA01', // Khách hàng 1
                'ngayDatHang' => Carbon::now()->subDays(7)->toDateTimeString(),
                'tongTien' => 1500000,
                'trangThaiDonHang' => 'Đang xử lý',
                'diaChiGiaoHang' => '123 Đường Lê Duẩn, Quận Hải Châu, Đà Nẵng',
                'trangThaiThanhToan' => 'Chưa thanh toán',
                'maNhanVienGiaoHang' => 3,
                'maNhanVienDuyet' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'taiKhoan' => 'NguyenVanB02', // Khách hàng 2
                'ngayDatHang' => Carbon::now()->subDays(5)->toDateTimeString(),
                'tongTien' => 2500000,
                'trangThaiDonHang' => 'Đang vận chuyển',
                'diaChiGiaoHang' => '45 Đường Nguyễn Văn Linh, Quận Thanh Khê, Đà Nẵng',
                'trangThaiThanhToan' => 'Đã thanh toán',
                'maNhanVienGiaoHang' => 3,
                'maNhanVienDuyet' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'taiKhoan' => 'NguyenVanA01', // Khách hàng 3
                'ngayDatHang' => Carbon::now()->subDays(3)->toDateTimeString(),
                'tongTien' => 800000,
                'trangThaiDonHang' => 'Đã giao hàng',
                'diaChiGiaoHang' => '78 Đường Phan Chu Trinh, Quận Sơn Trà, Đà Nẵng',
                'trangThaiThanhToan' => 'Đã thanh toán',
                'maNhanVienGiaoHang' => 3,
                'maNhanVienDuyet' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'taiKhoan' => 'NguyenVanB02', // Khách hàng 4
                'ngayDatHang' => Carbon::now()->subDays(2)->toDateTimeString(),
                'tongTien' => 1200000,
                'trangThaiDonHang' => 'Hủy',
                'diaChiGiaoHang' => '56 Đường Võ Văn Kiệt, Quận Ngũ Hành Sơn, Đà Nẵng',
                'trangThaiThanhToan' => 'Hoàn tiền',
                'maNhanVienGiaoHang' => 3,
                'maNhanVienDuyet' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'taiKhoan' => 'NguyenVanA01', // Khách hàng 5
                'ngayDatHang' => Carbon::now()->subDay()->toDateTimeString(),
                'tongTien' => 500000,
                'trangThaiDonHang' => 'Đang xử lý',
                'diaChiGiaoHang' => '12 Đường Hoàng Diệu, Quận Hải Châu, Đà Nẵng',
                'trangThaiThanhToan' => 'Chưa thanh toán',
                'maNhanVienGiaoHang' => 3,
                'maNhanVienDuyet' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}
