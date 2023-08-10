<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutonotifTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autonotif_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('autonotif_id');
            $table->boolean('notifikasi');
            $table->text('template');
            $table->text('target');
            $table->text('event');
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
        Schema::dropIfExists('autonotif_templates');
    }
}
