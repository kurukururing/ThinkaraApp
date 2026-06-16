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
        Schema::create('quiz_soal', function (Blueprint $table) {
            $table->id('id_quiz_soal');
            $table->unsignedBigInteger('id_quiz');
            $table->unsignedBigInteger('id_soal');
            $table->unsignedInteger('urutan');              // urutan soal dalam quiz (1-5)
            $table->timestamps();
 
            $table->foreign('id_quiz')->references('id_quiz')->on('quiz')->onDelete('cascade');
            $table->foreign('id_soal')->references('id_soal')->on('soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_soal');
    }
};
