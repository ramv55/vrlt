<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LabResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('lab_results', function (Blueprint $table) {
          $table->increments('lab_results_id');
          $table->integer('client_id');
          $table->string('lab_number',100);
          $table->string('sample_type',20);
          $table->string('test_received_date', 20);
          $table->string('equipment_type',100);
          $table->string('viral_load_detectable',100);
          $table->string('hiv_viral_load_results',50);
          $table->string('date_of_reporting',20);
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
        Schema::drop('lab_results');
    }
}
