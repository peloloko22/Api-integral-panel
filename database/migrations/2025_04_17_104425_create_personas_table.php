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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('dni')->nullable()->index();
            $table->string('telefono')->nullable();
            $table->string('clase')->nullable();
            $table->string('alias')->nullable();
            $table->foreignId('tipo_persona_id')
                ->nullable()
                ->constrained('tipo_personas')
                ->nullOnDelete();
            $table->foreignId('genero_id')
                  ->nullable()
                  ->constrained('generos')
                  ->nullOnDelete();
            $table->foreignId('nacionalidad_id')
                ->nullable()->constrained('nacionalidades')
                ->nullOnDelete();
            $table->foreignId('sexo_id')
                ->nullable()->constrained('sexos')
                ->nullOnDelete();
            $table->foreignId('condicion_persona_id')
                ->nullable()->constrained('condicion_personas')
                ->nullOnDelete();
            $table->foreignId('ocupacion_id')
                ->nullable()->constrained('ocupaciones')
                ->nullOnDelete();
            $table->foreignId('nivel_instruccion_id')
                ->nullable()->constrained('nivel_instrucciones')
                ->nullOnDelete();
            $table->date("fecha_nacimiento")->nullable();
            $table->string('domicilio')->nullable();
            $table->foreignId('estado_civil_id')
                ->nullable()->constrained('estado_civiles')
                ->nullOnDelete();
            $table->boolean('no_identificable')->default(false);
            $table->string('no_identificable_nombre')->nullable();
            $table->foreignId('capacidad_persona_id')
                ->nullable()->constrained('capacidad_personas')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
