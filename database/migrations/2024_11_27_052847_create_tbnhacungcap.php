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
        Schema::create('tbnhacungcap', function (Blueprint $table) {
            $table->id('maNCC');
            $table->string('taiKhoan');
            $table->string('tenNCC');
            $table->string('diaChi');
            $table->string('sdt');
            $table->string('xuatXu');
            $table->boolean('pheDuyet')->default(false); // Thêm cột pheDuyet với giá trị mặc định là false
            $table->unsignedBigInteger('maDanhMuc');
            $table->timestamps();

            $table->foreign('taiKhoan')
                ->references('taiKhoan')->on('tbtaikhoan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('maDanhMuc')
                ->references('maDanhMuc')->on('tbdanhmuc')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbnhacungcap');
    }
};
