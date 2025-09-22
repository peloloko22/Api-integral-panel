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
        Schema::create('tipificacion_delitos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_delito_id')->constrained('categoria_delitos')->onDelete('cascade'); // Foreign key to categoria_delitos table
            $table->string('codigo_sat');
            $table->string('codigo_snic');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->boolean('homicidio')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipificacion_delitos');
    }
};
