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
        Schema::create('acquimode', function(Blueprint $table){
            $table->increments('Pk_aquisModeId');
            $table->unsignedInteger('Fk_aquisId')->required();
            $table->unsignedInteger('Fk_sourceId')->nullable();

            $table->foreign('Fk_aquisId')
            ->references('Pk_acquisitionId')
            ->on('acquisition');
            $table->foreign('Fk_sourceId')
            ->references('Pk_sourceId')
            ->on('acquisource');
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
