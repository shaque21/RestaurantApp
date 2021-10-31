<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ordr_details', function (Blueprint $table) {
            $table->id();
            $table->string('ord_tracking_id');
            $table->INTEGER('ord_id');
            $table->INTEGER('mnu_id');
            $table->INTEGER('qty')->default(1);
            $table->Double('disc')->default(0);
            $table->Double('price');
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
        Schema::dropIfExists('order_details');
    }
}
