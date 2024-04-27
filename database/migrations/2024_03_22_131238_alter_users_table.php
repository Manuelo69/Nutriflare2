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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('progreso_id')->nullable();
            $table->unsignedBigInteger('objetivo_id')->nullable();
            $table->foreign('progreso_id')->references('id')->on('progresos')->onDelete('set null');
            $table->foreign('objetivo_id')->references('id')->on('objetivos')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar las restricciones de clave externa
            $table->dropForeign(['progreso_id']);
            $table->dropForeign(['objetivo_id']);

            // Eliminar las columnas añadidas
            $table->dropColumn('progreso_id');
            $table->dropColumn('objetivo_id');
        });
    }
};