<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->unsignedBigInteger('id_responden');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->tinyInteger('skor');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_responden')->references('id_responden')->on('respondens')->cascadeOnDelete();
            $table->foreign('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaans')->cascadeOnDelete();
            $table->unique(['id_responden', 'id_pertanyaan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawabans');
    }
};
