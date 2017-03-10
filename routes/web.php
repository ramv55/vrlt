<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return view('login');
});

Route::get('login', array('uses' => 'Auth\LoginController@showLogin'));
// route to process the form
Route::post('login', array('uses' => 'Auth\LoginController@doLogin'));
Route::get('logout', array('uses' => 'Auth\LoginController@doLogout'));
Route::get('dashboard',
array('uses' => 'DashboardController@showDashboard')
);

Route::get('addclient', array('uses' => 'ClientController@addClient'));

Route::post('clientdetails',
array('uses' => 'ClientController@store')
);

Route::post('updateclientdetails',
array('uses' => 'ClientController@update')
);

Route::post('savetreatment',
array('uses' => 'TreatmentController@store')
);

Route::post('savetreatmentlabwork',
array('uses' => 'TreatmentController@storelabwork')
);

Route::post('addtreatment',
array('uses' => 'TreatmentController@add')
);

Route::post('addtreatmentlabwork',
array('uses' => 'TreatmentController@addLabWork')
);

Route::post('savelabresults',
array('uses' => 'LabResultsController@store')
);

Route::post('addlabresults',
array('uses' => 'LabResultsController@add')
);

Route::post('savedischarge',
array('uses' => 'DischargeController@store')
);

Route::post('updatedischarge',
array('uses' => 'DischargeController@update')
);

Route::post('savecomment',
array('uses' => 'CommentController@store')
);

Route::post('addcomment',
array('uses' => 'CommentController@add')
);

Route::get('editclient/{id}', array('uses' => 'ClientController@editClient'));

Route::get('search', array('uses' => 'SearchController@getSearchdetails'));

//lab
Route::get('labs',
    array('uses' => 'LabController@index')
);

Route::post('labs',
    array('uses' => 'LabController@index')
);
Route::post('addlab',
array('uses' => 'LabController@store')
);

Route::post('deletelab',
array('uses' => 'LabController@delete')
);

Route::post('editlab',
array('uses' => 'LabController@update')
);

//facilities
Route::get('facilities',
    array('uses' => 'FacilityController@index')
);

Route::post('facilities',
    array('uses' => 'FacilityController@index')
);

Route::post('addfacility',
    array('uses' => 'FacilityController@store')
);

Route::post('editfacility',
    array('uses' => 'FacilityController@update')
);

Route::post('deletefacility',
    array('uses' => 'FacilityController@delete')
);

//users
Route::get('users',
    array('uses' => 'UserController@index')
);

Route::post('users',
    array('uses' => 'UserController@index')
);

Route::post('adduser',
    array('uses' => 'UserController@store')
);

Route::post('updateuser',
    array('uses' => 'UserController@update')
);

Route::post('deleteuser',
    array('uses' => 'UserController@delete')
);
