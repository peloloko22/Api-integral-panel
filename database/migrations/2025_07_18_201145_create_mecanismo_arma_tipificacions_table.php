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
        Schema::create('mecanismo_arma_tipificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mecanismo_arma_id')
                ->constrained('mecanismo_armas')
                ->onDelete('cascade');
            $table->foreignId('tipificacion_id')
                ->constrained('tipificacion_delitos')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mecanismo_arma_tipificaciones');
    }
};
