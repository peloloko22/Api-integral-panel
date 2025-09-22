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
        Schema::create('tiempo_espacio_registros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registro_id')
                ->constrained('registros')
                ->cascadeOnDelete();
            $table->foreignId("localidad_id")
                ->nullable()
                ->constrained('localidades')
                ->nullOnDelete();
            $table->foreignId("tipo_lugar_id")
                ->nullable()->constrained('tipo_lugares')
                ->nullOnDelete();
            $table->foreignId("tipo_via_id")
                ->nullable()->constrained('tipo_vias')
                ->nullOnDelete();
            $table->foreignId("paraje_id")
                ->nullable()->constrained('parajes')->nullOnDelete();
            $table->foreignId("barrio_id")
                ->nullable()->constrained('barrios')
                ->nullOnDelete();
            $table->datetime('fecha_hecho')->nullable();
            $table->datetime('fecha_denuncia');
            $table->string('dia_de_la_semana')->nullable();
            $table->foreignId("franja_horaria_id")
                ->nullable()
                ->constrained('franja_horarias')
                ->nullOnDelete();
            $table->string('mas_detalles_direccion')->nullable();
            $table->string('calle_ruta')->nullable();
            $table->string('altura_km')->nullable();
            $table->foreignId('tipo_zona_id')
                ->nullable()
                ->constrained('tipo_zonas')
                ->nullOnDelete();
            $table->decimal('latitud', 10, 6)->nullable();
            $table->decimal('longitud', 10, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiempo_espacio_registros');
    }
};
