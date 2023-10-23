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
        Schema::create('regulars', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->string('po_number')->nullable();
            $table->string('po_date')->nullable();
            $table->string('ors_num')->nullable();
            $table->string('po_conformed')->nullable();
            $table->string('invoice_rec')->nullable();
            $table->string('iar')->nullable();
            $table->string('remarks')->nullable();

            $table->bigInteger('FK_fund_cluster_id')->unsigned()->nullable();
            $table->foreign('FK_fund_cluster_id')->references('id')->on('fund_clusters');
            
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
        Schema::dropIfExists('regulars');
    }
};
