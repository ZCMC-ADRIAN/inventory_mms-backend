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
        Schema::create('inventories', function (Blueprint $table) {

            $table->increments('Pk_inventoryId');
            $table->unsignedInteger('Fk_itemId');
            $table->unsignedInteger('Fk_assocId');
            $table->unsignedInteger('Fk_conditionsId');

            $table->foreign('Fk_ItemId')->references('Pk_itemId')->on('items');
            $table->foreign('Fk_assocId')->references('Pk_assocId')->on('associate');
            $table->foreign('Fk_conditionsId')->references('PK_conditionsId')->on('conditions');

            $table->string('IAR_num')->nullable();
            $table->date('IAR_date')->nullable();
            $table->date('Delivery_date')->nullable();
            $table->integer('Quantity')->nullable();
            $table->integer('pack_size')->nullable();
            $table->integer('loose')->nullable();
            $table->text('Remarks')->nullable();
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