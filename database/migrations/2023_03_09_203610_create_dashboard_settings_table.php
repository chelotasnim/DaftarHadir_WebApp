<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('quick_setting');
            $table->string('theme');
            $table->boolean('blob');
            $table->boolean('shadow');
            $table->boolean('filter');
            $table->boolean('transition');
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
        Schema::dropIfExists('dashboard_settings');
    }
}
