<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqDepartemensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_departemens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id');
            $table->foreignId('penerima_id')->nullable();
            $table->foreignId('departemen_id')->nullable();
            $table->string('nama_dept');
            $table->string('atasan1')->nullable();
            $table->string('telp_1')->nullable();
            $table->string('atasan2')->nullable();
            $table->string('telp_2')->nullable();
            $table->string('atasan3')->nullable();
            $table->string('telp_3')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('req_departemens');
    }
}
