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
        Schema::create('vehiculos_novedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("novedad_id")->constrained("novedades")->onDelete("cascade");
            $table->foreignId("vehiculo_id")->constrained("vehiculos")->onDelete("cascade");
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos_novedades');
    }
};
