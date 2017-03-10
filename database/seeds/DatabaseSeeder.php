<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name'     => 'Terry Oehrke',
        'username' => 'clinic_user',
        'password' => Hash::make('test@123#'),
        'email'	   => 'test@gmail.com',
        'facility_name' =>  'Test Facility Name',
        'facility_code' => 123456789,
        'facility_level' => 'TestL',
        'region' => 'testRegion',
        'district' => 'testdistrict',
        'clinic_id' => 1,
        'role' => 1,
        'status' => 1
      ]);
    }
}
