<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqAktivitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id');
            $table->foreignId('penerima_id')->nullable();
            $table->foreignId('aktivitas_id')->nullable();
            $table->foreignId('departemen_id');
            $table->string('aktivitas');
            $table->string('status');
            $table->text('list_perubahan')->nullable();
            $table->string('keterangan_pengirim');
            $table->string('jenis_pengajuan');
            $table->string('status_pengajuan');
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
        Schema::dropIfExists('req_aktivitas');
    }
}
