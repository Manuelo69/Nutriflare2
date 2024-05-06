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
        Schema::create('objetivos', function (Blueprint $table) {
            $table->id();
            $table->integer('altura_objetivo');
            $table->integer('peso_objetivo');
            $table->integer('grasa_corporal_objetivo')->nullable();
            $table->integer('imc_objetivo')->nullable();
            $table->integer('minutos_cardio_objetivo')->nullable();
            $table->integer('horas_sueño_objetivo')->nullable();
            $table->integer('minutos_sueño_objetivo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivo');
    }
};
