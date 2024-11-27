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
        Schema::create('tbtaikhoan', function (Blueprint $table) {
            $table->string('tenTaiKhoan')->primary();
            $table->string('quyen'); 
            $table->string('matKhau'); 
            $table->string('email')->unique(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbtaikhoan');
    }
};
