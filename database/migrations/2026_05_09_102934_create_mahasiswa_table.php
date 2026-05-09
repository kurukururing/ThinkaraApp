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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->unsignedBigInteger('id_akun');
            $table->string('npm', 11)->unique();
            $table->string('nama_mahasiswa');
            $table->string('jenis_kelamin', 20);
            $table->string('jenjang', 20);
            $table->date('tanggal_lahir');
            $table->string('instansi');
            $table->timestamps();

            $table->foreign('id_akun')
                  ->references('id_akun')
                  ->on('akun')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
