<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\ClientDetails;
use App\Models\Treatment;
use App\Models\TreatmentOrderLabWork;
use App\Models\LabResults;
use App\Models\Discharge;
use App\Models\Comments;
use App\User;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
class ClientController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function addClient(){
		Session::forget('client_id');
		return view('addclient');
	}

	public function store(){

	//client details
		$client_id1 = Input::get('client_id1');
		$client_id2 = Input::get('client_id2');
		$client_dob = Input::get('client_dob');
		$client_name = Input::get('client_name');
		$client_age = Input::get('client_age');
		$client_gender = Input::get('client_gender');
		$pregnant_bf = Input::get('pregnant_bf');
		$enrolled_in = Input::get('enrolled_in');
		$pmtct_enrollment = Input::get('pmtct_enrollment');
		$phone = Input::get('phone');
		$tb_suspect = Input::get('tb_suspect');
		$tb_medication  = Input::get('tb_medication');
		$client_uid = $client_id1.'-'.$client_id2;
		$user_id = Auth::id();

		$id = DB::table('client_details')->insertGetId(
				array(
					'client_uid' => $client_uid,
					'dob' => $client_dob,
					'age' => $client_age,
					'gender' => $client_gender,
					'name' => $client_name,
					'pregnant_feeding' => $pregnant_bf,
					'currently_enrolled_in' => $enrolled_in,
					'pmct_enrolment_date' => $pmtct_enrollment,
					'phone' => $phone,
					'tb_suspect' => $tb_suspect,
					'tb_medication' => $tb_medication,
					'client_counselled' => 0,
					'increase_note'	=> 0,
					'created_by' => $user_id
				));

		if($id){
			Session::put('client_id', $id);
			Session::put('gender', $client_gender);
			Session::put('pregnant_feeding', $pregnant_bf);
			Session::put('currently_enrolled_in', $enrolled_in);
			Session::put('pmct_enrolment_date', $pmtct_enrollment);

			return Response::json(array('status' => 'success',
																	'gender' => Session::get('gender'),
																	'pregnant_feeding' => Session::get('pregnant_feeding'),
																	'currently_enrolled_in' => Session::get('currently_enrolled_in'),
																	'pmct_enrolment_date' => Session::get('pmct_enrolment_date')));
		}else{
			return Response::json(array('status' => 'fail'));
		}
	}


	public function editClient($id){

			$clientdetails = DB::table('client_details')
											->select('*')
											->where('client_id', '=', $id)->first();

				$treatment = DB::table('treatment')
													->select('*')
													->where('client_id', '=', $id)
													->orderBy('treatment_id','desc')->first();

				$treatmentlabwork = DB::table('order_lab_work')
													->select('*')
													->where('client_id', '=', $id)
													->orderBy('order_lab_work_id','desc')->first();

				$labresults = DB::table('lab_results')
													->select('*')
													->where('client_id', '=', $id)
													->orderBy('lab_results_id','desc')->first();

			 $discharge = DB::table('discharge')
												->select('*')
												->where('client_id', '=', $id)->first();

				$comments = DB::table('comments')
													->select('*')
													->where('client_id', '=', $id)
													->orderBy('comments_id','desc')->first();

				// $lastresult  = DB::select("select * from (select * from lab_results where client_id = '$id' order by lab_results_id desc limit 1,1) t group by t.client_id");

				

		return view('editclient')
						->with('clientdetails', $clientdetails)
						->with('treatment', $treatment)
						->with('treatmentlabwork', $treatmentlabwork)
						->with('labres', $labresults)
						->with('discharge', $discharge)
						->with('comments', $comments)
						->with('id', $id);
	}

	public function update(){

			$id = Input::get('id');

		//client details
			$client_id1 = Input::get('client_id1');
			$client_id2 = Input::get('client_id2');
			$client_dob = Input::get('client_dob');
			$client_name = Input::get('client_name');
			$client_age = Input::get('client_age');
			$client_gender = Input::get('client_gender');
			$pregnant_bf = Input::get('pregnant_bf');
			$enrolled_in = Input::get('enrolled_in');
			$pmtct_enrollment = Input::get('pmtct_enrollment');
			$phone = Input::get('phone');
			$tb_suspect = Input::get('tb_suspect');
			$tb_medication  = Input::get('tb_medication');
			$client_uid = $client_id1.'-'.$client_id2;
			$client_counselled = Input::get('client_counselled');
			$increase_note = Input::get('increase_note');


			$update = DB::table('client_details')->where('client_id', '=', $id)->update(
					array(
						'client_uid' => $client_uid,
						'dob' => $client_dob,
						'age' => $client_age,
						'gender' => $client_gender,
						'name' => $client_name,
						'pregnant_feeding' => $pregnant_bf,
						'currently_enrolled_in' => $enrolled_in,
						'pmct_enrolment_date' => $pmtct_enrollment,
						'phone' => $phone,
						'tb_suspect' => $tb_suspect,
						'tb_medication' => $tb_medication,
						'client_counselled' => $client_counselled,
						'increase_note'	=> $increase_note
					));


			if($update){

				Session::put('gender', $client_gender);
				Session::put('pregnant_feeding', $pregnant_bf);
				Session::put('currently_enrolled_in', $enrolled_in);
				Session::put('pmct_enrolment_date', $pmtct_enrollment);

				return Response::json(array('status' => 'success',
																		'gender' => Session::get('gender'),
																		'pregnant_feeding' => Session::get('pregnant_feeding'),
																		'currently_enrolled_in' => Session::get('currently_enrolled_in'),
																		'pmct_enrolment_date' => Session::get('pmct_enrolment_date')));
			}else{
				return Response::json(array('status' => 'fail'));
			}

	}

}
