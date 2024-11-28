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
        Schema::create('tbnhanvien', function (Blueprint $table) {
            $table->id('maNhanVien');
            $table->string('taiKhoan');
            $table->string('hoTen');
            $table->string('chucVu');
            $table->string('ngaySinh');
            $table->string('cccd');
            $table->string('sdt');
            $table->string('diachi');

            $table->timestamps();

            $table->foreign('taiKhoan')
            ->references('taiKhoan')->on('tbtaikhoan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbnhanvien');
    }
};
