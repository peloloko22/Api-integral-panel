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
        Schema::create('alerta_jerarquias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_alerta_id')->constrained('tipo_alertas')->onDelete('cascade');
            $table->foreignId('jerarquia_id')->constrained('jerarquias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerta_jerarquias');
    }
};
