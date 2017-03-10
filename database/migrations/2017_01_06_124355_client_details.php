<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('client_details', function (Blueprint $table) {
          $table->increments('client_id');
          $table->integer('client_uid');
          $table->string('dob');
          $table->string('name');
          $table->string('age',10);
          $table->enum('gender', ['M', 'F']);
          $table->enum('pregnant_feeding', ['1','0']);
          $table->enum('currently_enrolled_in', ['1','0']);
          $table->string('pmct_enrolment_date',20);
          $table->string('phone');
          $table->integer('created_by');
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
        Schema::drop('client_details');
    }
}
