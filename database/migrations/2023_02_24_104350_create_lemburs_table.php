<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemburs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id');
            $table->foreignId('departemen_id');
            $table->foreignId('pegawai_id');
            $table->string('tanggal');
            $table->string('mulai');
            $table->string('sampai');
            $table->string('keterangan_aktivitas');
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
        Schema::dropIfExists('lemburs');
    }
}
