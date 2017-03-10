<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Discharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('discharge', function (Blueprint $table) {
          $table->increments('discharge_id');
          $table->integer('client_id');
          $table->enum('client_discharged', ['1', '0']);
          $table->string('date_of_discharge',20);
          $table->text('reason_for_discharge');
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
        Schema::drop('discharge');
    }
}
