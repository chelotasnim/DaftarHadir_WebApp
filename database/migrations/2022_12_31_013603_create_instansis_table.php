<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('logo_instansi')->nullable();
            $table->string('nama_instansi');
            $table->string('deskripsi_instansi');
            $table->string('alamat_instansi');
            $table->string('kontak_instansi');
            $table->string('website_instansi')->nullable();
            $table->string('type');
            $table->string('hari_kerja');
            $table->string('type_jadwal');
            $table->string('smart_wages')->nullable();
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
        Schema::dropIfExists('instansis');
    }
}
