<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calificacion_hechos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('codigo_sat')->unique();
            $table->string('codigo_snic')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_hechos');
    }
};
