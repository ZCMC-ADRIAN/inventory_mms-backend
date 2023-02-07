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
        //
        Schema::create('locat_man', function (Blueprint $table) {

            $table->increments('Pk_locatmanId');
            $table->unsignedInteger('Fk_assocId')->nullable();
            $table->unsignedInteger('Fk_locationId')->notNullable();
            $table->foreign('Fk_assocId')->references('Pk_assocId')->on('associate');
            $table->foreign('Fk_locationId')->references('Pk_locationId')->on('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
