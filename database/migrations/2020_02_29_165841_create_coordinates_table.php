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
            $table->string('tops')->default('No Item');
            $table->string('bottoms')->default('No Item');
            $table->string('outer')->default('No Item');
            $table->string('shoes')->default('No Item');
            $table->string('other')->default('No Item');
            $table->string('events')->default('Nothing much....');
            $table->string('image_path')->nullable();
            $table->string('date');
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
