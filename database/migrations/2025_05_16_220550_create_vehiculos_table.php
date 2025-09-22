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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('dominio')->unique();
            $table->foreignId('tipo_vehiculo_id')->nullable()
                ->constrained('tipo_vehiculos')
                ->nullOnDelete();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('color')->nullable();
            $table->string('numero_motor')->nullable();
            $table->string('numero_chasis')->nullable();
            $table->string('extra')->nullable();
            $table->boolean('pedido_captura')->default(false);
            $table->boolean('no_identificable')->default(false);
            $table->string('no_identificable_nombre')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
