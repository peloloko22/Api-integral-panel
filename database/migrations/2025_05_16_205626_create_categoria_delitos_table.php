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
        Schema::create('categoria_delitos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_sat')->unique();
            $table->string('codigo_snic')->unique();
            $table->string("nombre");
            $table->string("descripcion")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_delitos');
    }
};
