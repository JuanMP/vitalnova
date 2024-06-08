<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dateTime('appointment_start')->after('date')->nullable(); // Nueva columna para el inicio de la cita
            $table->dateTime('appointment_end')->after('appointment_start')->nullable(); // Nueva columna para el fin de la cita
            $table->unsignedBigInteger('status_id')->after('appointment_end')->nullable(); // Nueva columna para el estado de la cita

            $table->foreign('status_id')->references('id')->on('appointment_status')->onDelete('set null'); // Añadir la clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('appointment_start');
            $table->dropColumn('appointment_end');
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};
