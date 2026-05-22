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
        Schema::create('soal_item_qte', function (Blueprint $table) {
            $table->id('id_item_qte');
            $table->unsignedBigInteger('id_soal');
            $table->string('isi_item'); // Kata atau frasa yang akan muncul
            $table->boolean('is_correct')->default(false); // Kunci jawaban: true jika kata tsb adalah jawaban benar
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
        Schema::dropIfExists('soal_item_qte');
    }
};
