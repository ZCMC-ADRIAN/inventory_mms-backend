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
            // $table->unsignedInteger('Fk_itemId');
            // $table->unsignedInteger('Fk_conditionsId');
            // $table->unsignedInteger('Fk_locatmanId')->nullable();

            // $table->foreign('Fk_ItemId')->references('Pk_itemId')->on('items');
            // $table->foreign('Fk_conditionsId')->references('PK_conditionsId')->on('conditions');
            // $table->foreign('Fk_locatmanId')->references('Pk_locatmanId')->on('locat_man')->nullable();
            
            // $table->string('IAR_num')->nullable();
            // $table->date('IAR_date')->nullable();
            $table->date('Delivery_date')->nullable();
            $table->integer('Quantity')->nullable();
            $table->string('property_no')->nullable();
            $table->string('serial')->nullable();
            $table->integer('loose')->nullable();
            $table->text('Remarks')->nullable();
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
        Schema::dropIfExists('inventories');
    }
};
