<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ztps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('ztp_name');
            $table->integer('account_id');
            $table->integer('account_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ztps');
    }
}
