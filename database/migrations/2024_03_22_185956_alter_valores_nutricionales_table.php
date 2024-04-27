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
        Schema::table('valores_nutricionales', function (Blueprint $table) {
            $table->unsignedBigInteger('plato_id');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valores_nutricionales', function (Blueprint $table) {
            // Eliminar las restricciones de clave externa
            $table->dropForeign(['plato_id']);
            // Eliminar las columnas añadidas
            $table->dropColumn('plato_id');
        });
    }
};