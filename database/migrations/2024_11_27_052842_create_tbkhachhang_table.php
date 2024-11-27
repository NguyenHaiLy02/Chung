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
            $table->string('tenTaiKhoan'); 
            $table->string('sdt'); 
            $table->string('diaChi'); 
            $table->timestamps(); 

            $table->foreign('tenTaiKhoan')->references('tenTaiKhoan')->on('tbtaikhoan')
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
