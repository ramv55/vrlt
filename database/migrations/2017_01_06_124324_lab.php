<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('lab', function (Blueprint $table) {
          $table->increments('lab_id');
          $table->string('lab_name');
          $table->string('lab_code');
          $table->string('lab_location');
          $table->string('phone',20);
          $table->enum('status', ['1', '0']);
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
        Schema::drop('lab');
    }
}
