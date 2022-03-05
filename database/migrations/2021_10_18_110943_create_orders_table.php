<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ordr_master', function (Blueprint $table) {
            $table->id();
            $table->string('ord_tracking_id');
            $table->INTEGER('res_own_id');
            $table->INTEGER('res_id');
            $table->string('cus_name')->nullable();
            $table->string('cus_mob')->nullable();
            $table->string('pay_method');
            $table->Double('sub_total');
            $table->INTEGER('attr1')->nullable();
            $table->INTEGER('attr2')->nullable();
            $table->string('attr3')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
