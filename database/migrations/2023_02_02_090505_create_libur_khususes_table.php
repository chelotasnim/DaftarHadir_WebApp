<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiburKhususesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libur_khususes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departemen_id');
            $table->string('nama_libur');
            $table->string('mulai');
            $table->string('sampai');
            $table->text('pengumuman');
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
        Schema::dropIfExists('libur_khususes');
    }
}
