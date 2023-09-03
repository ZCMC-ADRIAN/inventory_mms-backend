<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');

            $table->bigInteger('setting_id')->unsigned();
            $table->foreign('setting_id')->references('id')->on('settings')->onCascade('delete');

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
        Schema::dropIfExists('settings_data');
    }
};
