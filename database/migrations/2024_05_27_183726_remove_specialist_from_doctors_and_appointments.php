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
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('specialist');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('specialist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('specialist')->nullable();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->string('specialist')->nullable();
        });
    }
};
