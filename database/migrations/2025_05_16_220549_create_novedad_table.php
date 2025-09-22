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
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->text("detalle_sintesis");
            $table->datetime("hora_hecho")->nullable();
            $table->string("altura_km")->nullable();
            $table->string("calle_ruta")->nullable();
            $table->text("mas_detalles_direccion")->nullable();
            $table->foreignId("fiscal_id")->nullable()->constrained("fiscales")->nullOnDelete();
            $table->foreignId("tipo_novedad_id")->nullable()->constrained("tipo_novedades")->nullOnDelete();
            $table->foreignId("barrio_id")->nullable()->constrained("barrios")->nullOnDelete();
            $table->foreignId("dependencia_id")->nullable()->constrained("dependencias")->nullOnDelete();
            $table->double("latitud")->nullable();
            $table->double("longitud")->nullable();
            $table->foreignId("user_id")->nullable()->constrained("users")->nullOnDelete();
            $table->boolean('revisada')->nullable()->default(false);
            $table->boolean("incluir_parte")->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};
