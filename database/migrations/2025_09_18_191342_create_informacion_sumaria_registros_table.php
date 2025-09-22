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
        Schema::create('informacion_sumaria_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')->constrained('registros')->onDelete('cascade')->name('fk_info_sumaria_registro');
            $table->foreignId('tipo_informacion_sumaria_id')->constrained('tipo_informacion_sumarias')->onDelete('cascade')->name('fk_info_sumaria_tipo');
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_sumaria_registros');
    }
};
