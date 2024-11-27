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
        Schema::create('tbchungnhan', function (Blueprint $table) {
            $table->id('maChungNhan');
            $table->unsignedBigInteger('maNCC');
            $table->string('hinhanh');
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
        Schema::dropIfExists('tbchungnhan');
    }
};
