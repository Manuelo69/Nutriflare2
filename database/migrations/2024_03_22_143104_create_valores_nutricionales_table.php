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
        Schema::create('valores_nutricionales', function (Blueprint $table) {
            $table->id();
            $table->integer('calorias');
            $table->integer('azucar');
            $table->integer('carbohidratos');
            $table->integer('grasas');
            $table->integer('vitaminas');
            $table->integer('proteinas');
            $table->integer('fibra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valores_nutricionales');
    }
};
