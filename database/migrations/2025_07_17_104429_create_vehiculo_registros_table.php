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
        Schema::create('vehiculo_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                ->constrained('registros')
                ->cascadeOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->cascadeOnDelete();
            $table->foreignId('estado_vehiculo_registro_id')->nullable()->constrained('estado_vehiculo_registros')->cascadeOnDelete();
            $table->string('descripcion')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo_registros');
    }
};
