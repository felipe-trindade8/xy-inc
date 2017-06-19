<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiTable extends Migration
{
    /**
     * Run the migrations.
     * Creating POI's table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('coordinate_x')->unsigned();
            $table->integer('coordinate_y')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poi');
    }
}
