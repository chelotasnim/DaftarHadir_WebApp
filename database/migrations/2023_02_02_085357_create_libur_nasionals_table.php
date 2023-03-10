<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiburNasionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libur_nasionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id');
            $table->string('nama_libur');
            $table->string('mulai');
            $table->string('sampai');
            $table->text('pengumuman')->nullable();
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
        Schema::dropIfExists('libur_nasionals');
    }
}
