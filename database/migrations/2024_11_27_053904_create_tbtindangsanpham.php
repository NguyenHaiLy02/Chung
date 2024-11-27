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
        Schema::create('tbtindangsanpham', function (Blueprint $table) {
            $table->id('maTin');
            $table->unsignedBigInteger('maNCC');
            $table->string('tenSP');
            $table->string('moTa');
            $table->decimal('giaSP');
            $table->string('donViTinh');
            $table->datetime('ngaySanXuat');
            $table->datetime('ngayHetHan');            
            $table->integer('soLuong');
            $table->timestamps();
            
            $table->foreign('maNCC')
            ->references('maNCC')->on('tbnhacungcap')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbtindangsanpham');
    }
};
