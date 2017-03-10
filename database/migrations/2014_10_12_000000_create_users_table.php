<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('user_id');
          $table->integer('clinic_id');
          $table->integer('lab_id');
          $table->string('name');
          $table->string('username')->unique();
          $table->string('email',100);
          $table->string('password');
          $table->string('facility_name',50);
          $table->string('facility_code',20);
          $table->string('facility_level',20);
          $table->string('region',50);
          $table->string('district',50);
          $table->integer('role');
          $table->enum('status', ['1', '0']);
          $table->rememberToken();
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
        Schema::drop('users');
    }
}
