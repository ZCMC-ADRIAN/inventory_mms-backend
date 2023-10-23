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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('FK_article_id')->nullable();
            $table->foreign('FK_article_id')->references('id')->on('articles');

            $table->unsignedBigInteger('FK_type_id')->nullable();
            $table->foreign('FK_type_id')->references('id')->on('types');

            $table->unsignedBigInteger('FK_manufacturer_id')->nullable();
            $table->foreign('FK_manufacturer_id')->references('id')->on('manufacturers');

            $table->unsignedBigInteger('FK_supplier_id')->nullable();
            $table->foreign('FK_supplier_id')->references('id')->on('suppliers');

            $table->unsignedBigInteger('FK_unit_id')->nullable();
            $table->foreign('FK_unit_id')->references('id')->on('units');

            $table->unsignedBigInteger('FK_variety_id')->nullable();
            $table->foreign('FK_variety_id')->references('id')->on('varieties');

            $table->unsignedBigInteger('FK_brand_id')->nullable();
            $table->foreign('FK_brand_id')->references('id')->on('brands');

            $table->unsignedBigInteger('FK_country_id')->nullable();
            $table->foreign('FK_country_id')->references('id')->on('countries');
                        
            $table->unsignedBigInteger('FK_item_category_id')->nullable();
            $table->foreign('FK_item_category_id')->references('id')->on('item_categories');

            $table->string('model')->nullable();
            $table->string('details2',1000)->nullable();
            $table->string('accessories',3000)->nullable();
            $table->string('other')->nullable();
            $table->date('warranty')->nullable();
            $table->date('acquisition_date')->nullable();
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
        Schema::dropIfExists('items');
    }
};
