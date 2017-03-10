<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Discharge;
use App\User;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
class DischargeController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}



	public function store(){

		$date_of_discharge = Input::get('date_of_discharge');
		$discharge_reason = Input::get('discharge_reason');
		$is_discharge  = Input::get('is_discharge');

		$add_discharge = Discharge::create(
				array(
					'client_id' => Session::get('client_id'),
					'client_discharged' => $is_discharge,
					'date_of_discharge' => $date_of_discharge,
					'reason_for_discharge' => $discharge_reason
				));

				if($add_discharge){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

	public function update(){
		$id = Input::get('id');
		$date_of_discharge = Input::get('date_of_discharge');
		$discharge_reason = Input::get('discharge_reason');
		$is_discharge  = Input::get('is_discharge');

		$update_discharge = Discharge::where('client_id', '=', $id)->update(
				array(
					'client_id' => $id,
					'client_discharged' => $is_discharge,
					'date_of_discharge' => $date_of_discharge,
					'reason_for_discharge' => $discharge_reason
				));



				if($update_discharge){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

}
