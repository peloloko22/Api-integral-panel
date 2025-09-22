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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('denuncia_id')->nullable()->constrained('denuncias')->nullOnDelete();
            $table->foreignId('tipo_registro_id')
                ->nullable()
                ->constrained('tipo_registros')
                ->nullOnDelete();
            $table->foreignId('departamental_id')
                ->nullable()
                ->constrained('departamentales')
                ->nullOnDelete();
            $table->foreignId('dependencia_id')
                ->nullable()
                ->constrained('dependencias')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
