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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->boolean('enviada')->default(false);
            $table->dateTime('fecha_hora_envio')->nullable();
            $table->foreignId('tipo_alerta_id')->constrained('tipo_alertas')->onDelete('cascade');
            $table->foreignId('novedad_id')->nullable()->constrained('novedades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
