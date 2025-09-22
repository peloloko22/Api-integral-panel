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
        Schema::create('calificacion_tipificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calificacion_id')->constrained('calificacion_hechos')->cascadeOnDelete();
            $table->foreignId('tipificacion_id')->constrained('tipificacion_delitos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_tipificaciones');
    }
};
