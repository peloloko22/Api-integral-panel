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
        Schema::create('multimedia_novedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novedad_id')->constrained("novedades")->onDelete('cascade');
            $table->string('ruta'); // path del archivo en storage
            $table->string('tipo', 50); // mime type: image/png, video/mp4, etc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia_novedades');
    }
};
