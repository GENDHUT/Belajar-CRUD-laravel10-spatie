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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('judul_foto', 225);
            $table->text('deskripsi_foto')->nullable();
            $table->date('tanggal_unggah');
            $table->string('lokasi_file', 225);
            $table->timestamps();

            $table->foreignId('album_id')->nullable()->constrained('albums')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
