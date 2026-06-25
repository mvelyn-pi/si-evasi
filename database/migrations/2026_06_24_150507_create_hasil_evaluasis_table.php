<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_evaluasis', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->unsignedBigInteger('id_responden')->unique();
            $table->decimal('skor_pemahaman', 4, 2)->nullable();
            $table->decimal('skor_pu', 4, 2)->nullable();
            $table->decimal('skor_peou', 4, 2)->nullable();
            $table->decimal('skor_atu', 4, 2)->nullable();
            $table->decimal('skor_bi', 4, 2)->nullable();
            $table->decimal('skor_sus', 5, 2)->nullable();
            $table->string('kategori_pemahaman')->nullable();
            $table->string('kategori_tam')->nullable();
            $table->string('kategori_sus')->nullable();
            $table->timestamps();

            $table->foreign('id_responden')->references('id_responden')->on('respondens')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_evaluasis');
    }
};
