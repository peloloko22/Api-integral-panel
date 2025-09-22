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
        Schema::create('elementos_novedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("novedad_id")->constrained("novedades")->cascadeOnDelete();
            $table->foreignId("estado_elemento_id")->constrained("estado_elementos")->cascadeOnDelete();
            $table->foreignId("categoria_elemento_id")->constrained("categoria_elementos")->cascadeOnDelete();
            $table->integer("cantidad")->nullable();
            $table->decimal('valor', 16, 4)->default(1.00)->nullable();
            $table->string("detalles")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos_novedades');
    }
};
