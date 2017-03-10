<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Treatment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('treatment', function (Blueprint $table) {
          $table->increments('treatment_id');
          $table->integer('client_id');
          $table->string('art_status',100);
          $table->string('art_initiated_date',20);
          $table->string('art_medication', 50);
          $table->string('previous_regimens',20);
          $table->string('test_requested_date',20);
          $table->string('test_requested_date_hvl',20);
          $table->string('sample_collected_date',20);
          $table->string('sample_shipped_date',20);
          $table->string('collected_by');
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
        Schema::drop('treatment');
    }
}
