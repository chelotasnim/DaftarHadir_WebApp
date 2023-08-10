<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutonotifQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autonotif_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('autonotif_id');
            $table->text('data');
            $table->text('template');
            $table->text('target');
            $table->text('event');
            $table->string('status');
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
        Schema::dropIfExists('autonotif_queues');
    }
}
