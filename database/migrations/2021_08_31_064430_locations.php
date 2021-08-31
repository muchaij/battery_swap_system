<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Locations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("locations", function(Blueprint $table){
            $table->id();
            $table->bigInteger("user_id");
            $table->bigInteger("assignment_id");
            $table->double("latitude");
            $table->double("longitude");
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
        Schema::dropIfExists("locations");
    }
}
