<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
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
            $table->rememberToken();
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
        Schema::dropIfExists('pegawais');
    }
}
