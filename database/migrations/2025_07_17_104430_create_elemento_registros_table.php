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
        Schema::create('elemento_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                ->constrained('registros')
                ->cascadeOnDelete();
            $table->foreignId('categoria_elemento_id')
                ->constrained('categoria_elementos')
                ->cascadeOnDelete();
            $table->foreignId('tipo_moneda_id')
                ->nullable()
                ->constrained('tipo_monedas')
                ->cascadeOnDelete();
            $table->foreignId('estado_elemento_id')
                ->constrained('estado_elementos')
                ->cascadeOnDelete();
            $table->decimal('cantidad', 8, 2)->default(1.00);
            $table->string('marca')->nullable();
            $table->string('color')->nullable();
            $table->decimal('valor', 16, 4)->default(1.00)->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha_secuestro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemento_registros');
    }
};
