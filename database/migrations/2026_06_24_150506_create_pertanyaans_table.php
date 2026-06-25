<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->id('id_pertanyaan');
            $table->enum('jenis_kuesioner', ['pemahaman', 'tam', 'sus']);
            $table->string('konstruk')->nullable();
            $table->integer('nomor_item');
            $table->text('teks_pertanyaan');
            $table->boolean('is_reverse')->default(false);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaans');
    }
};
