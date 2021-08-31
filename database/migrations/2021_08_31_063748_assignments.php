<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("assignments", function(Blueprint $table){
            $table->id();
            $table->integer("user_id");
            $table->integer("battery_id");
            $table->integer("station_id");
            $table->boolean("status");
            $table->integer("pickup_level");
            $table->integer("return_level");
            $table->double("amount")->nullable();
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
        Schema::dropIfExists("assignments");
    }
}
