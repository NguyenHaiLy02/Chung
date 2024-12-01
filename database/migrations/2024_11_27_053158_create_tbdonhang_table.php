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
            $table->string('taiKhoan');
            $table->date('ngayDatHang'); 
            $table->decimal('tongTien', 10, 0); 
            $table->string('trangThaiDonHang'); 
            $table->string('diaChiGiaoHang'); 
            $table->string('sdt'); 
            $table->string('trangThaiThanhToan'); 
            $table->unsignedBigInteger('maNhanVienGiaoHang')->nullable();  // Allow null
            $table->unsignedBigInteger('maNhanVienDuyet')->nullable();  // Allow null
            $table->timestamps(); 
            
            $table->foreign('taiKhoan')->references('taiKhoan')->on('tbtaikhoan')->onDelete('cascade');
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
