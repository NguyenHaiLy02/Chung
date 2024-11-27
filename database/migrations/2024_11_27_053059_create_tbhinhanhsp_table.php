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
        Schema::create('tbhinhanhsp', function (Blueprint $table) {
          
            $table->id('maHinhAnh'); 
            $table->unsignedBigInteger('maSanPham'); 
            $table->string('hinhAnh'); 
            $table->timestamps(); 
            
            $table->foreign('maSanPham')->references('maSanPham')->on('tbsanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbhinhanhsp');
    }
};
