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
        Schema::create('siniestro_vial_novedad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novedad_id')->constrained('novedades')->onDelete('cascade');
            $table->foreignId('tipo_siniestro_id')->constrained('tipo_siniestros')->onDelete('cascade');
            $table->boolean('fuga')->default(false);
            $table->boolean('alcohol')->default(false);
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siniestro_vial_novedad');
    }
};
