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
        Schema::create('siniestro_registro_participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siniestro_vial_id')
                ->constrained('siniestro_vial_registros')
                ->onDelete('cascade');
            $table->foreignId('rol_siniestro_id')
                ->constrained('rol_siniestros')
                ->onDelete('cascade');
            $table->boolean('fallecido')->default(false);
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->nullOnDelete();
            $table->foreignId('persona_id')->nullable()->constrained('personas')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siniestro_registro_participantes');
    }
};
