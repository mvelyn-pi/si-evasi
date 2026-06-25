<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('respondens', function (Blueprint $table) {
            $table->id('id_responden');
            $table->string('kode_responden')->unique();
            $table->unsignedBigInteger('id_polres');
            $table->string('jabatan');
            $table->string('lama_penggunaan');
            $table->string('frekuensi_penggunaan');
            $table->enum('pelatihan_sakti', ['Pernah', 'Belum']);
            $table->timestamps();

            $table->foreign('id_polres')->references('id_polres')->on('polres')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('respondens');
    }
};
