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
        Schema::create("funcionarios", function (Blueprint $table) {
            $table->id();
            $table->string("lp");
            $table->foreignId("usuario_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("jerarquia_id")->constrained("jerarquias")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("funcionarios");
    }
};
