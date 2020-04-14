<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('tops')->nullable();
            $table->string('bottoms')->nullable();
            $table->string('outer')->nullable();
            $table->string('shoes')->nullable();
            $table->string('other')->nullable();
            $table->string('events')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_path_100')->nullable();
            $table->string('date');
            $table->integer('rating');
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
        Schema::dropIfExists('coordinates');
    }

}
