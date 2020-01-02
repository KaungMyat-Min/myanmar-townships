<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelTownshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_township', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model_id')->unsigned();
            $table->string('model_type');
            $table->bigInteger('township_id')->unsigned();

            $table->foreign('township_id')
                ->references('id')
                ->on('townships')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_township');
    }
}
