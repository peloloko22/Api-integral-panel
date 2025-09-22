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
        Schema::create('suicidio_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')->constrained('registros')->cascadeOnDelete();
            $table->foreignId('testigo_id')->nullable()->constrained('personas')->cascadeOnDelete();
            $table->foreignId('suicida_id')->constrained('personas')->cascadeOnDelete();
            $table->foreignId('tipo_lugar_suicidio_id')->constrained('tipo_lugar_suicidios')->cascadeOnDelete();
            $table->foreignId('mecanismo_suicidio_id')->constrained('mecanismo_suicidios')->cascadeOnDelete();
            $table->foreignId('tipo_suicidio_id')->constrained('tipo_suicidios')->cascadeOnDelete();
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suicidio_registros');
    }
};
