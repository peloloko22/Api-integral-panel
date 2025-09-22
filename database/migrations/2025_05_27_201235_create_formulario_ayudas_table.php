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
        Schema::create('formulario_ayudas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('titulo');
            $table->foreignId('tipo_formulario_ayuda_id')
                ->constrained('tipo_formulario_ayudas')
                ->onDelete('cascade');
            $table->foreignId('usuario_id')
                ->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario_ayudas');
    }
};
