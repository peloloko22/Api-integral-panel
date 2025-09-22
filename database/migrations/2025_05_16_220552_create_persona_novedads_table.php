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
        Schema::create('persona_novedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("persona_id")->nullable()->constrained("personas")->nullOnDelete();
            $table->foreignId("novedad_id")->nullable()->constrained("novedades")->nullOnDelete();
            $table->foreignId('rol_persona_id')->nullable()->constrained('rol_personas')->nullOnDelete();
            $table->text('detalles_adicionales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_novedades');
    }
};
