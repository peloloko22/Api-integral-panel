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
        Schema::create('esclarecimiento_hechos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_hecho_id')->constrained('registro_hechos');
            $table->foreignId('tipo_esclarecimiento_hecho_id')->constrained('tipo_esclarecimiento_hechos');
            $table->longText('descripcion');
            $table->string('dependencia_esclarece');
            $table->datetime('fecha_esclarecimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esclarecimiento_hechos');
    }
};
