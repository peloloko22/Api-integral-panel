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
        Schema::create('delitos_novedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipificacion_delito_id')->constrained('tipificacion_delitos')->onDelete('cascade');
            $table->foreignId('modus_operandi_id')->nullable()->constrained('modus_operandis')->nullOnDelete();
            $table->foreignId('calificacion_id')->nullable()->constrained('calificacion_hechos')->nullOnDelete();
            $table->foreignId('novedad_id')->constrained('novedades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delitos_novedades');
    }
};
