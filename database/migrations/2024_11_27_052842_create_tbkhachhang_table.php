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
        Schema::create('tbkhachhang', function (Blueprint $table) {
            $table->id('maKhachHang');
            $table->string('taiKhoan'); 
            $table->string('tenTaiKhoan'); 
            $table->string('anhDaiDien'); 
            $table->string('sdt'); 
            $table->string('diaChi'); 
            $table->timestamps(); 

            $table->foreign('taiKhoan')->references('taiKhoan')->on('tbtaikhoan')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbkhachhang');
    }
};
