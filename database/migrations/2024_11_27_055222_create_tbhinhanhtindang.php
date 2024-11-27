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
        Schema::create('tbhinhanhtindang', function (Blueprint $table) {
            $table->id('maHinhAnh'); 
            $table->unsignedBigInteger('maTin');
            $table->string('hinhanh');
            $table->timestamps();

            
            $table->foreign('maTin')
            ->references('maTin')->on('tbtindangsanpham')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbhinhanhtindang');
    }
};
