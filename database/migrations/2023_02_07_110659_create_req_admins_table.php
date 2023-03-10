<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id');
            $table->foreignId('penerima_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('pegawai_id');
            $table->string('password');
            $table->string('peran');
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
        Schema::dropIfExists('req_admins');
    }
}
