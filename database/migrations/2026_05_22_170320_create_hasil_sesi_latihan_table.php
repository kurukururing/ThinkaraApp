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
        Schema::create('hasil_sesi_latihan', function (Blueprint $table) {
            $table->id('id_hasil_latihan');
            $table->unsignedBigInteger('id_akun');
            $table->unsignedBigInteger('id_latihan');
            $table->integer('xp');
            $table->integer('skor');
            $table->dateTime('waktu_main');
            $table->integer('durasi'); // Durasi dalam detik
            $table->timestamps();

            $table->foreign('id_akun')
                  ->references('id_akun')
                  ->on('akun')
                  ->onDelete('cascade');

            $table->foreign('id_latihan')
                  ->references('id_latihan')
                  ->on('latihan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_sesi_latihan');
    }
};
