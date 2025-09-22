<?php

use App\Models\HistorialNovedad;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_novedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novedad_id')
                ->constrained('novedades')
                ->onDelete('cascade');
            $table->foreignId('usuario_revision_id')->nullable()->constrained("users")->nullOnDelete();
            $table->json('contenido');
            $table->enum('accion', [HistorialNovedad::ACCION_CREACION, HistorialNovedad::ACCION_MODIFICACION, HistorialNovedad::ACCION_ELIMINACION])->default(HistorialNovedad::ACCION_CREACION);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_novedads');
    }
};
