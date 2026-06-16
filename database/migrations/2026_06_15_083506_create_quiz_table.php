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
        Schema::create('quiz', function (Blueprint $table) {
            $table->id('id_quiz');
            $table->unsignedBigInteger('id_akun');           // FK ke akun (dosen)
            $table->unsignedBigInteger('id_latihan');        // FK ke latihan (jenis latihan yang dipilih)
            $table->string('nama_quiz', 255);
            $table->string('slug', 100)->unique();           // link unik untuk dibagikan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
 
            $table->foreign('id_akun')->references('id_akun')->on('akun')->onDelete('cascade');
            $table->foreign('id_latihan')->references('id_latihan')->on('latihan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz');
    }
};
