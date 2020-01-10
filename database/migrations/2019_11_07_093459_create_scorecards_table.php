<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScorecardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorecards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('scorecard_name');
            $table->integer('account_type_id');
            $table->integer('account_id');
            $table->integer('status');
            $table->integer('parent');
            $table->integer('is_updated');
            $table->string('Version');
            $table->integer('created_by');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scorecards');
    }
}
