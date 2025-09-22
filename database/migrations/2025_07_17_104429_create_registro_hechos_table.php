<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registro_hechos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                ->constrained('registros')
                ->onDelete('cascade');
            $table->foreignId('tipificacion_id')->nullable()
                ->constrained('tipificacion_delitos')
                ->nullOnDelete();
            $table->foreignId('calificacion_id')
                ->nullable()
                ->constrained('calificacion_hechos')
                ->nullOnDelete();
            $table->foreignId('modus_id')
                ->nullable()
                ->constrained('modus_operandis')
                ->nullOnDelete();
            $table->foreignId('mecanismo_arma_id')
                ->nullable()
                ->constrained('mecanismo_armas')
                ->nullOnDelete();
            $table->boolean('imputado_conocido')->nullable();
            $table->foreignId('tipo_transporte_imputado_id')
                ->nullable()
                ->constrained('tipo_transporte_imputados')
                ->nullOnDelete();
            $table->foreignId('imputado_id')
                ->nullable()
                ->constrained('personas')
                ->nullOnDelete();
            $table->foreignId('victima_id')
                ->nullable()
                ->constrained('personas')
                ->nullOnDelete();
            $table->foreignId('victima_vinculo_id')
                ->nullable()
                ->constrained('vinculo_victimas')
                ->nullOnDelete();
            $table->boolean('es_femicidio')->nullable();
            $table->boolean('violencia_genero')->nullable();
            $table->foreignId('consecuencia_hecho_id')
                ->nullable()
                ->constrained('consecuencia_hechos')
                ->nullOnDelete();
            $table->boolean('posee_boton_antipanico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_hechos');
    }
};
