<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersLabDt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('alter table users change lab_id lab_id int(11) DEFAULT NULL');
        DB::statement('alter table users change clinic_id clinic_id int(11) DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('alter table users change lab_id lab_id int(11) DEFAULT NONE');
        DB::statement('alter table users change clinic_id clinic_id int(11) DEFAULT NONE');
    }
}
