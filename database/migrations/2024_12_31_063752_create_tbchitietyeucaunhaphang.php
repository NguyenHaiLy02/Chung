<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration tạo bảng tbchitietyeucaunhaphang
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbchitietyeucaunhaphang', function (Blueprint $table) {
            $table->id('maChiTietYeuCau'); // Mã chi tiết yêu cầu
            $table->unsignedBigInteger('maYeuCau'); // Mã yêu cầu nhập hàng
            $table->unsignedBigInteger('maTin'); // Mã tin đăng sản phẩm
            $table->integer('soLuongYeuCau'); // Số lượng yêu cầu
            $table->decimal('giaTien', 10, 2); // Giá tiền
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('maYeuCau')
                  ->references('maYeuCau')->on('tbyeucaunhaphang')
                  ->onDelete('cascade');

            $table->foreign('maTin')
                  ->references('maTin')->on('tbtindangsanpham')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbchitietyeucaunhaphang');
    }
};
