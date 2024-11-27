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
        Schema::create('tbsanpham', function (Blueprint $table) {
          
            $table->id('maSanPham'); 
            $table->string('tenSanPham');
            $table->text('moTa')->nullable(); 
            $table->string('cachBaoQuan')->nullable();
            $table->decimal('giaTien', 10, 2); 
            $table->string('donViTinh'); 
            $table->date('ngaySanXuat'); 
            $table->date('ngayHetHan'); 
            $table->integer('soLuongTonKho'); 
            $table->unsignedBigInteger('maNCC'); 
            $table->unsignedBigInteger('maDanhMuc'); 
            $table->timestamps(); 
            
            $table->foreign('maNCC')->references('maNCC')->on('tbnhacungcap')->onDelete('cascade');
            $table->foreign('maDanhMuc')->references('maDanhMuc')->on('tbdanhmuc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbsanpham');
    }
};
