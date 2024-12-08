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
        Schema::create('tbchitietdonhang', function (Blueprint $table) {
            $table->id('maChiTietDonHang'); 
            $table->unsignedBigInteger('maDonHang'); 
            $table->unsignedBigInteger('maSanPham'); 
            $table->integer('soLuong');
            $table->decimal('donGia', 10, 2); 
            $table->boolean('daDanhGia')->default(false); // Cột trạng thái đánh giá
            $table->timestamps();
            
            $table->foreign('maDonHang')->references('maDonHang')->on('tbdonhang')->onDelete('cascade');
            $table->foreign('maSanPham')->references('maSanPham')->on('tbsanpham')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbchitietdonhang');
    }
};
