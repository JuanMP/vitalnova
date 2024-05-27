<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Modificar las tablas existentes para añadir las claves foráneas
        Schema::table('treatments', function (Blueprint $table) {
            $table->unsignedBigInteger('specialist_id')->nullable()->after('id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('set null');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('specialist_id')->nullable()->after('id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('set null');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('specialist_id')->nullable()->after('id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign(['specialist_id']);
            $table->dropColumn('specialist_id');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['specialist_id']);
            $table->dropColumn('specialist_id');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['specialist_id']);
            $table->dropColumn('specialist_id');
        });

        Schema::dropIfExists('specialists');
    }
}
