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
        Schema::create('soal_item_fix', function (Blueprint $table) {
            $table->id('id_item_fix');
            $table->unsignedBigInteger('id_soal');
            $table->text('isi_item');
            $table->integer('urutan_benar'); // Kunci jawaban: urutan yang benar (misal: 1, 2, 3...)
            $table->timestamps();

            // Menambahkan foreign key ke tabel soal
            $table->foreign('id_soal')->references('id_soal')->on('soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_item_fix');
    }
};