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
        Schema::create('tbgiohang', function (Blueprint $table) {
            $table->id();
            $table->string('taiKhoan'); 
            $table->unsignedBigInteger('maSanPham'); 
            $table->integer('soLuong'); 
            $table->timestamps();
            
            $table->foreign('taiKhoan')->references('taiKhoan')->on('tbtaikhoan')->onDelete('cascade');
            $table->foreign('maSanPham')->references('maSanPham')->on('tbsanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbgiohang');
    }
};
