<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        Schema::create('associate', function (Blueprint $table) {
            $table->increments('Pk_assocId');
            $table->string('person_name')->nullable()->notNullable();
            $table->unsignedInteger('Fk_locationId')->notNullable();
            $table->foreign('Fk_locationId')->references('Pk_locationId')->on('location');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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