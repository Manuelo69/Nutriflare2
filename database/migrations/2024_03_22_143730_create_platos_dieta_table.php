<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('platos_dieta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_id');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');
            $table->unsignedBigInteger('dieta_id');
            $table->foreign('dieta_id')->references('id')->on('dietas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platos_dieta');
    }
};