<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_kerja_id');
            $table->string('log_name');
            $table->string('hari');
            $table->string('log_type');
            $table->string('log_time');
            $table->string('log_limit');
            $table->string('log_tolerance');
            $table->string('log_range');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_details');
    }
}
