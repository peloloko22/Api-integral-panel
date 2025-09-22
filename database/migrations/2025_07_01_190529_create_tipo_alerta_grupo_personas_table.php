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
        Schema::create('tipo_alerta_grupo_personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_alerta_id')
                ->constrained('tipo_alertas')
                ->onDelete('cascade');
            $table->foreignId('grupo_persona_id')
                ->constrained('grupo_personas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_alerta_grupo_personas');
    }
};
