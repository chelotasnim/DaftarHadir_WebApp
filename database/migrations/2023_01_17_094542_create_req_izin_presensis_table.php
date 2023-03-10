<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqIzinPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_izin_presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id');
            $table->foreignId('penerima_id')->nullable();
            $table->foreignId('izin_id')->nullable();
            $table->foreignId('pegawai_id');
            $table->string('mulai');
            $table->string('sampai');
            $table->string('keterangan');
            $table->string('lampiran')->nullable();
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
        Schema::dropIfExists('req_izin_presensis');
    }
}
