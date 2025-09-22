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
        Schema::create('persona_informacion_sumarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informacion_sumaria_registro_id')->constrained('informacion_sumaria_registros')->onDelete('cascade')->name('fk_persona_info_sumaria');
            $table->foreignId('persona_id')->nullable()->constrained('personas')->onDelete('cascade')->name('fk_persona_info_persona');
            $table->longText('extra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_informacion_sumarias');
    }
};
