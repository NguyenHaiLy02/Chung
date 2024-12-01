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
        Schema::create('tbdanhgiasanpham', function (Blueprint $table) {
            $table->id('maDanhGia'); // Khóa chính, tự động tăng
            $table->unsignedBigInteger('maChiTietDonHang'); // Liên kết với bảng chi tiết đơn hàng
            $table->unsignedTinyInteger('soLuongSao')->comment('Số lượng sao đánh giá từ 1 đến 5'); // Số sao từ 1-5
            $table->text('noiDung')->nullable()->comment('Nội dung đánh giá'); // Nội dung đánh giá
            $table->timestamps();

            // Khóa ngoại liên kết với bảng tbChiTietDonHang
            $table->foreign('maChiTietDonHang')
                ->references('maChiTietDonHang') 
                ->on('tbchitietdonhang') 
                ->onUpdate('cascade') 
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbdanhgiasanpham');
    }
};
