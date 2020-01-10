<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScorecardBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorecard_bodies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('scorecard_id');
            $table->integer('category_id');
            $table->integer('parameter_id');
            $table->integer('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scorecard_bodies');
    }
}
