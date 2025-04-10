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
        Schema::create('dat_ve_du_lich', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nguoi_dat');
            $table->string('email')->nullable();
            $table->integer('so_luong');
            $table->decimal('tong_tien', 10, 2);
            $table->string('hinh_thuc_thanh_toan');
            $table->tinyInteger('trang_thai')->default(0); // 0: Chưa xử lý, 1: Đã xác nhận
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dat_ve_du_lich');
    }
};
