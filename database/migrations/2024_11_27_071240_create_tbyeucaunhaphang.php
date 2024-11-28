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
        Schema::create('tbyeucaunhaphang', function (Blueprint $table) {
            $table->id('maYeuCau'); // Mã yêu cầu nhập hàng
            $table->unsignedBigInteger('maTin'); // Mã tin đăng sản phẩm
            $table->integer('soLuongYeuCau'); // Số lượng yêu cầu
            $table->decimal('giaTien', 10, 2); // Giá tiền
            $table->string('trangThai'); // Trạng thái yêu cầu (e.g., Đang chờ duyệt, Đã duyệt)
            $table->string('trangThaiThanhToan'); // Trạng thái thanh toán (e.g., Đã thanh toán, Chưa thanh toán)
            $table->date('ngayNhanDuKien'); // Ngày nhận dự kiến
            $table->date('ngayNhanThucTe')->nullable(); // Ngày nhận thực tế
            $table->unsignedBigInteger('maNhanVien')->nullable(); // Mã nhân viên phụ trách
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('maTin')
                  ->references('maTin')->on('tbtindangsanpham')
                  ->onDelete('cascade');

            $table->foreign('maNhanVien')
                  ->references('maNhanVien')->on('tbnhanvien')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbyeucaunhaphang');
    }
};
