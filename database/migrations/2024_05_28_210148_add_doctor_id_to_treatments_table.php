<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorIdToTreatmentsTable extends Migration
{
    public function up()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->foreignId('doctor_id')->constrained('users');
        });
    }

    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropColumn('doctor_id');
        });
    }
}
