<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\LabResults;
use App\Models\TreatmentOrderLabWork;
use App\Models\ClientDetails;
use App\User;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
class LabResultsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}



	public function store(){


		$test_received_date = Input::get('test_received_date');
		$equipment_type  = Input::get('equipment_type');
		$viral_load_detectable	 = Input::get('viral_load_detectable');
		$hiv_viral_load_results = Input::get('hiv_viral_load_results');
		$date_of_reporting = Input::get('date_of_reporting');
		$lab_no = Input::get('lab_no');

		$treatment_order_lab_work = TreatmentOrderLabWork::where('client_id', '=', Session::get('client_id'))
							->orderBy('order_lab_work_id','desc')->first();
		$treatment_order_lab_work_id = $treatment_order_lab_work->order_lab_work_id;

		$add_labresults = LabResults::create(
				array(
					'client_id' => Session::get('client_id'),
					'lab_no'	=> $lab_no,
					'order_lab_work_id' => $treatment_order_lab_work_id,
					'test_received_date' => $test_received_date,
					'equipment_type' => $equipment_type,
					'viral_load_detectable' => $viral_load_detectable,
					'hiv_viral_load_results' => $hiv_viral_load_results,
					'date_of_reporting' => $date_of_reporting,
					'created_lab_id' => Auth::user()->clinic_id
				));

				if($add_labresults){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}


	public function add(){

		$id = Input::get('id');

		$test_received_date = Input::get('test_received_date');
		$equipment_type  = Input::get('equipment_type');
		$viral_load_detectable	 = Input::get('viral_load_detectable');
		$hiv_viral_load_results = Input::get('hiv_viral_load_results');
		$date_of_reporting = Input::get('date_of_reporting');
		$lab_no = Input::get('lab_no');


		$treatment_order_lab_work = TreatmentOrderLabWork::where('client_id', '=', $id)
							->orderBy('order_lab_work_id','desc')->first();
		$treatment_order_lab_work_id = $treatment_order_lab_work->order_lab_work_id;

		$add_labresults = LabResults::create(
				array(
					'client_id' => $id,
					'lab_no'	=> $lab_no,
					'order_lab_work_id' => $treatment_order_lab_work_id,
					'test_received_date' => $test_received_date,
					'equipment_type' => $equipment_type,
					'viral_load_detectable' => $viral_load_detectable,
					'hiv_viral_load_results' => $hiv_viral_load_results,
					'date_of_reporting' => $date_of_reporting,
					'created_lab_id' => Auth::id()
				));

				$lastresult  = DB::select("select * from (select * from lab_results where client_id = '$id' order by lab_results_id desc limit 1,1) t group by t.client_id");

				if(@$lastresult[0]->hiv_viral_load_results != ''){
					if(@$lastresult[0]->hiv_viral_load_results >= 1000){
							ClientDetails::where('client_id', $id)->update(
								array(
									'client_counselled'	=> 1
								));
					}
				}

				$current_viral_load = $hiv_viral_load_results;
				if(@$lastresult[0]->hiv_viral_load_results != ''){
						if($current_viral_load >= (@$lastresult[0]->hiv_viral_load_results*1.25)){
							ClientDetails::where('client_id', $id)->update(
								array(
									'increase_note'	=> 1
								));
						}
			}

				if($add_labresults){
					$j = 0;
					$res = '';
					$previouslabresults = DB::select("select * from lab_results where lab_results_id != (SELECT MAX(lab_results_id) FROM lab_results where client_id = '$id') and client_id = '$id' order by lab_results_id desc");
					foreach ($previouslabresults as $prlabres) {
						$TreatmentOrderLabWork = TreatmentOrderLabWork::where('order_lab_work_id', '=', $prlabres->order_lab_work_id)->first();
							if($j%2 != 0){
								$rwclass = 'odd';
								$bg = '';
							}else {
								$rwclass = '';
								$bg = 'bgcolor="#f1f2f1"';
							}

							if($prlabres->test_received_date != ''){
							$res .= '<tr class="'.$rwclass.'">
								<td '.$bg.'>'.$TreatmentOrderLabWork->sample_shipped_date.'</td>
								<td '.$bg.'>'.$prlabres->test_received_date.'</td>
								<td '.$bg.'>'.$prlabres->date_of_reporting.'</td>
								<td '.$bg.'>'.$TreatmentOrderLabWork->sample_type.'</td>
								<td '.$bg.'>'.$prlabres->viral_load_detectable.'</td>
								<td '.$bg.'>'.$prlabres->hiv_viral_load_results.'</td>
							</tr>';
						}
						$j++;
					}
					return Response::json(array('status' => 'success', 'lb_results' => $res));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

}
