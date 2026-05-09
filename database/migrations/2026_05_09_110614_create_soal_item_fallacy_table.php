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
        Schema::create('soal_item_fallacy', function (Blueprint $table) {
            $table->id('id_item_fallacy');
            $table->unsignedBigInteger('id_soal');
            $table->string('jenis_kesalahan');
            $table->boolean('is_correct')->default(true);
            $table->timestamps();

            $table->foreign('id_soal')
                  ->references('id_soal')
                  ->on('soal')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_item_fallacy');
    }
};
