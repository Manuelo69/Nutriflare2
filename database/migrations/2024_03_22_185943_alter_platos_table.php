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
        Schema::table('platos', function (Blueprint $table) {
            $table->unsignedBigInteger('valor_nutricional_id')->nullable();
            $table->foreign('valor_nutricional_id')->references('id')->on('valores_nutricionales')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            // Eliminar las restricciones de clave externa
            $table->dropForeign(['valor_nutricional_id']);
            // Eliminar las columnas añadidas
            $table->dropColumn('valor_nutricional_id');
        });
    }
};
