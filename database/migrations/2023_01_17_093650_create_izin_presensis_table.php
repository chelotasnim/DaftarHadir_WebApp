<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id');
            $table->foreignId('departemen_id');
            $table->foreignId('pegawai_id');
            $table->string('mulai');
            $table->string('sampai');
            $table->string('keterangan');
            $table->string('lampiran')->nullable();
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
        Schema::dropIfExists('izin_presensis');
    }
}
