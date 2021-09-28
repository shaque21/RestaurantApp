<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->integer('rstown_id');
            $table->string('phone',15);
            $table->string('photo')->nullable();
            $table->integer('restaurant_id')->unique();
            $table->string('restaurant_name');
            $table->string('restaurant_address');
            $table->string('rstown_slug',50)->unique()->nullable();
            $table->integer('rst_status')->default(0);
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
        Schema::dropIfExists('restaurants');
    }
}
