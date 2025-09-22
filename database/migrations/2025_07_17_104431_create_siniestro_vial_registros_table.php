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
        Schema::create('siniestro_vial_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                ->constrained('registros')
                ->cascadeOnDelete();
            $table->foreignId('tipo_siniestro_id')->constrained('tipo_siniestros')->onDelete('cascade');
            $table->boolean('fuga');
            $table->boolean('alcohol');
            $table->foreignId('semaforo_siniestro_id')->constrained('semaforo_siniestros')->onDelete('cascade');
            $table->foreignId('condicion_climatica_id')->constrained('condicion_climaticas')->onDelete('cascade');
            $table->foreignId('tipo_lugar_siniestro_vial_id')->constrained('tipo_lugar_siniestro_viales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siniestro_vial_registros');
    }
};
