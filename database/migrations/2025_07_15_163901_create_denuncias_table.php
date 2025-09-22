<?php

use App\Enums\TipoDenuncia;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tipo_denuncia_id")->nullable()->constrained('tipo_denuncias')
                ->nullOnDelete();
            $table->foreignId('tipificacion_delito_id')->nullable()->constrained('tipificacion_delitos')->nullOnDelete();
            $table->foreignId('dependencia_id')->nullable()->constrained('dependencias')->nullOnDelete();

            $table->foreignId('fiscal_id')->nullable()->constrained('fiscales')->nullOnDelete();
            $table->string('funcionario_interviniente')->nullable();

            $table->foreignId('victima_id')->nullable()->constrained('personas')->nullOnDelete();
            $table->foreignId('denunciante_id')->nullable()->constrained('personas')->nullOnDelete();

            $table->dateTime('fecha_hecho');
            $table->dateTime('fecha_denuncia');

            $table->boolean('registrada_en_estadisticas')->default(false);

            // Relato textual
            $table->longText('relato');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
