<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id');
            $table->foreignId('penerima_id')->nullable();
            $table->foreignId('pegawai_id')->nullable();
            $table->foreignId('jabatan_id');
            $table->foreignId('fp_id')->nullable();
            $table->string('nip');
            $table->string('nama'); 
            $table->string('email')->unique();
            $table->integer('tunjangan_tetap');
            $table->integer('tunjangan_bulan_ini');
            $table->string('password')->nullable();
            $table->string('no_hp');
            $table->string('no_wa');            
            $table->string('alamat');
            $table->string('tgl_lahir');
            $table->string('jns_kel');
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
        Schema::dropIfExists('req_pegawais');
    }
}
