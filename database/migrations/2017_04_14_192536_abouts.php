<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Abouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
      Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header');
            $table->string('header2');
            $table->string('header3');
            $table->longText('body');
            $table->longText('body2');
            $table->longText('body3');
            $table->longText('image');
            $table->longText('image2');
            $table->longText('image3');
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
        Schema::dropIfExists('abouts');
    }
}
