<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbdonhang', function (Blueprint $table) {
            $table->id('maDonHang'); 
            $table->unsignedBigInteger('tenTaiKhoan');
            $table->date('ngayDatHang'); 
            $table->decimal('tongTien', 10, 2); 
            $table->string('trangThaiDonHang'); 
            $table->string('diaChiGiaoHang'); 
            $table->string('trangThaiThanhToan'); 
            $table->unsignedBigInteger('maNhanVienGiaoHang'); 
            $table->unsignedBigInteger('maNhanVienDuyet'); 
            $table->timestamps(); 
            
            $table->foreign('tenTaiKhoan')->references('tenTaiKhoan')->on('tbtaikhoan')->onDelete('cascade');
            $table->foreign('maNhanVienGiaoHang')->references('maNhanVien')->on('tbnhanvien')->onDelete('cascade');
            $table->foreign('maNhanVienDuyet')->references('maNhanVien')->on('tbnhanvien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbdonhang');
    }
};
