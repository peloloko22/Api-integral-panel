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
        Schema::create('modus_operandi_tipificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modus_operandi_id')
                ->constrained('modus_operandis')
                ->onDelete('cascade');
            $table->foreignId('tipificacion_delito_id')
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
        Schema::dropIfExists('modus_operandi_tipificacions');
    }
};
