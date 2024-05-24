<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('email');
            $table->string('telephone');
            $table->text('comentario')->nullable();
            $table->string('specialist');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->unsignedBigInteger('user_id')->nullable(); //Añade esta línea si queremos vincular citas a usuarios (YA VINCULADO)
            $table->timestamps();

            //Para vincular citas a usuarios, descomentar la siguiente línea
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
