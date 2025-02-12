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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->timestamp('tanggal_penjualan')->default(now());
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->timestamps();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
