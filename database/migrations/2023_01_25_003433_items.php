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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('Pk_itemId');
            $table->unsignedInteger('Fk_typeId')->nullable();
            $table->unsignedInteger('Fk_statusId')->nullable();
            $table->unsignedInteger('Fk_manuId')->nullable();
            $table->unsignedInteger('Fk_supplierId')->nullable();
            $table->unsignedInteger('Fk_unitId')->nullable();
            $table->unsignedInteger('Fk_varietyId')->nullable();
            $table->unsignedInteger('Fk_brandId')->nullable();
            $table->unsignedInteger('Fk_countryId')->nullable();

            $table->foreign('Fk_typeId')->references('Pk_typeId')->on('types');
            $table->foreign('Fk_statusId')->references('Pk_statusId')->on('status');
            $table->foreign('Fk_manuId')->references('Pk_manuId')->on('manufacturers');
            $table->foreign('Fk_supplierId')->references('Pk_supplierId')->on('suppliers');
            $table->foreign('Fk_unitId')->references('Pk_unitId')->on('units');
            $table->foreign('Fk_varietyId')->references('Pk_varietyId')->on('variety');
            $table->foreign('Fk_brandId')->references('Pk_brandId')->on('brands');
            $table->foreign('Fk_countryId')->references('Pk_countryId')->on('countries');

            $table->string('item_name')->nullable();
            $table->string('model')->nullable();
            $table->string('details2')->nullable();
            $table->string('other')->nullable();
            // $table->string('serial')->nullable();
            $table->date('warranty')->nullable();
            $table->date('acquisition_date')->nullable();
            // $table->string('property_no')->nullable();
            $table->date('expiration')->nullable();
            $table->string('fundSource')->nullable();
            $table->double('cost', 10, 2)->default(0.00);
            $table->string('remarks')->nullable();
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
