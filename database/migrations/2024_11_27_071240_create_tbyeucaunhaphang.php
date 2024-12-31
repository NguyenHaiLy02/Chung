<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration tạo bảng tbYeuCauNhapHang
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbyeucaunhaphang', function (Blueprint $table) {
            $table->id('maYeuCau'); // Mã yêu cầu nhập hàng
            $table->string('trangThaiYeuCau'); // Trạng thái yêu cầu (e.g., Đang chờ duyệt, Đã duyệt)
            $table->string('trangThaiThanhToan'); // Trạng thái thanh toán (e.g., Đã thanh toán, Chưa thanh toán)
            $table->decimal('tongTien', 15, 2)->default(0); // Tổng tiền yêu cầu nhập hàng
            $table->date('ngayNhanDuKien'); // Ngày nhận dự kiến
            $table->date('ngayNhanThucTe')->nullable(); // Ngày nhận thực tế
            $table->unsignedBigInteger('maNhanVien')->nullable(); // Mã nhân viên phụ trách
            $table->timestamps();

            // Khóa ngoại
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