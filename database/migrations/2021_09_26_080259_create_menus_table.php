<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->string('food_description')->nullable();
            $table->string('food_photo')->nullable();
            $table->integer('category_id');
            $table->integer('food_price');
            $table->integer('discount_id')->default(0)->nullable();
            $table->string('food_slug')->unique();
            $table->integer('user_id');
            $table->string('restaurant_id');
            $table->integer('food_status')->default(1);
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
        Schema::dropIfExists('menus');
    }
}
