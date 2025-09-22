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
        Schema::create('siniestro_novedad_participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siniestro_id')->constrained('siniestro_vial_novedad')->onDelete('cascade');
            $table->foreignId('rol_siniestro_id')->constrained('rol_siniestros')->onDelete('cascade');
            $table->foreignId("persona_id")->nullable()->constrained('personas')->nullOnDelete();
            $table->foreignId("vehiculo_id")->nullable()->constrained('vehiculos')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siniestro_novedad_participantes');
    }
};
