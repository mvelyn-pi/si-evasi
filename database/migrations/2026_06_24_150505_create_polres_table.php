<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polres', function (Blueprint $table) {
            $table->id('id_polres');
            $table->string('nama_polres');
            $table->string('wilayah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polres');
    }
};
