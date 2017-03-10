<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Treatment;
use App\Models\TreatmentOrderLabWork;
use App\Models\LabResults;
use App\Models\ClientDetails;
use App\User;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
class TreatmentController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}



	public function store(){
		$artstatus = Input::get('art_status');
		$date_initiated_on_art = Input::get('date_initiated_on_art');
		$artmedication  = Input::get('artmedication');
		$previous_regimens	 = Input::get('previous_regimens');

		$add_treatment = Treatment::create(
				array(
					'client_id' => Session::get('client_id'),
					'art_status' => $artstatus,
					'art_initiated_date' => $date_initiated_on_art,
					'art_medication' => $artmedication,
					'previous_regimens' => $previous_regimens
				));

				if($add_treatment){


					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}

	}

	public function storelabwork(){
		$sample_collection_date = Input::get('sample_collection_date');
		$test_reason = Input::get('test_reason');
		$collected_by  = Input::get('collected_by');
		$sample_shipped_date	 = Input::get('sample_shipped_date');
		$test_requested_by	 = Input::get('test_requested_by');
		$counseling	 = Input::get('counseling');
		$sample_type	 = Input::get('sample_type');
		$nxttestdate	 = Input::get('nexttestdate');

		$id = DB::table('order_lab_work')->insertGetId(
				array(
					'client_id' => Session::get('client_id'),
					'sample_collected_date' => $sample_collection_date,
					'reason_for_test' => $test_reason,
					'collected_by' => $collected_by,
					'test_requested_by' => $test_requested_by,
					'counseling'	=> $counseling,
					'sample_type'	=> $sample_type,
					'sample_shipped_date'	=> $sample_shipped_date,
					'nexttestdate'	=> $nxttestdate
				));

			$lab_results = LabResults::create(array(
					'client_id'	=> Session::get('client_id'),
					'order_lab_work_id'	=>	$id
			));

				if($id && $lab_results){
					return Response::json(array('status' => 'success',
																			'sample_collection_date' => $sample_collection_date,
																			'sample_shipped_date' => $sample_shipped_date,
																			'reason_for_test'	=> $test_reason));
				}else{
					return Response::json(array('status' => 'fail'));
				}

	}

	public function add(){
		$id = Input::get('id');
		$clientdetails = DB::table('client_details')
										->select('*')
										->where('client_id', '=', $id)->first();

		$artstatus = Input::get('art_status');
		$date_initiated_on_art = Input::get('date_initiated_on_art');
		$artmedication  = Input::get('artmedication');
		$previous_regimens	 = Input::get('previous_regimens');

		$add_treatment = Treatment::create(
				array(
					'client_id' => $id,
					'art_status' => $artstatus,
					'art_initiated_date' => $date_initiated_on_art,
					'art_medication' => $artmedication,
					'previous_regimens' => $previous_regimens
				));



				if($add_treatment){

							$res = '';
							$i = 0;
							$previoustreatmentlists = DB::select("select * from treatment where treatment_id != (SELECT MAX(treatment_id) FROM treatment where client_id = '$id') and client_id = '$id' order by treatment_id desc");
							foreach ($previoustreatmentlists as $prtreatment) {
									if($i%2 != 0){
										$rwclass = 'odd';
										$bg = '';
									}else {
										$rwclass = '';
										$bg = 'bgcolor="#f1f2f1"';
									}

									if($clientdetails->gender == "M"){
										$gender = "Male";
									}else {
										$gender =  "Female";
									}

									if($clientdetails->pregnant_feeding == 1){
										$pr_bf = 'Yes';
									}else {
										$pr_bf = "No";
									}

									if($clientdetails->currently_enrolled_in == 1){
										$enrolled_in = 'Yes';
									}else {
										$enrolled_in = "No";
									}


									$res .= '<tr class="'.$rwclass.'">
										<td '.$bg.'>'.date("d/m/Y", strtotime($prtreatment->created_at)).'</td>
										<td '.$bg.'>'.$prtreatment->art_status.'</td>
										<td '.$bg.'>'.$prtreatment->art_initiated_date.'</td>
										<td '.$bg.'>'.$prtreatment->art_medication.'</td>
										<td '.$bg.'>'.$gender.'</td>
										<td '.$bg.'>'.$pr_bf.'</td>
										<td '.$bg.'>'.$enrolled_in.'</td>
										<td '.$bg.'>'.$clientdetails->pmct_enrolment_date.'</td>
										<td '.$bg.'>'.$prtreatment->previous_regimens.'</td>
									</tr>';

							$i++;
						}



					return Response::json(array('status' => 'success',
																		'tr_results' => $res));
				}else{
					return Response::json(array('status' => 'fail'));
				}
			}


			public function addLabWork(){
				$id = Input::get('id');

				$sample_collection_date = Input::get('sample_collection_date');
				$test_reason = Input::get('test_reason');
				$collected_by  = Input::get('collected_by');
				$sample_shipped_date	 = Input::get('sample_shipped_date');
				$test_requested_by	 = Input::get('test_requested_by');
				$counseling	 = Input::get('counseling');
				$sample_type	 = Input::get('sample_type');
				$nxttestdate	 = Input::get('nexttestdate');

				$add_treatmentlab = TreatmentOrderLabWork::create(
						array(
							'client_id' => $id,
							'sample_collected_date' => $sample_collection_date,
							'reason_for_test' => $test_reason,
							'collected_by' => $collected_by,
							'test_requested_by' => $test_requested_by,
							'counseling'	=> $counseling,
							'sample_type'	=> $sample_type,
							'sample_shipped_date'	=> $sample_shipped_date,
							'nexttestdate'	=> $nxttestdate
						));

						ClientDetails::where('client_id', $id)->update(
							array(
								'increase_note'	=> 0
							));

							ClientDetails::where('client_id', $id)->update(
								array(
									'client_counselled'	=> 0
								));

						if($add_treatmentlab){

									$res = '';
									$j = 0;
									$previoustreatmentlabwork = DB::select("select * from order_lab_work where order_lab_work_id != (SELECT MAX(order_lab_work_id) FROM order_lab_work where client_id = '$id') and client_id = '$id' order by order_lab_work_id desc");
									foreach ($previoustreatmentlabwork as $prtreatmentlabwork) {
										if($j%2 != 0){
											$rwclass = 'odd';
											$bg = '';
										}else {
											$rwclass = '';
											$bg = 'bgcolor="#f1f2f1"';

										}
										if($prtreatmentlabwork->counseling == 1){
											$counseling =  'Yes';
										}else {
											$counseling =  'No';
										}

							$res .= '<tr class="'.$rwclass.'">
								<td '.$bg.'>'.date("d/m/Y", strtotime($prtreatmentlabwork->created_at)).'</td>
								<td '.$bg.'>'.$prtreatmentlabwork->sample_collected_date.'</td>
								<td '.$bg.'>'.$prtreatmentlabwork->reason_for_test.'</td>
								<td '.$bg.'>'.$prtreatmentlabwork->collected_by.'</td>
								<td '.$bg.'>'.$prtreatmentlabwork->test_requested_by.'</td>
								<td '.$bg.'>'.$counseling.'</td>
								<td '.$bg.'>'.$prtreatmentlabwork->sample_type.'</td>
								<td '.$bg.'>'.$prtreatmentlabwork->sample_shipped_date.'</td>
							</tr>';

									$j++;
								}
									return Response::json(array('status' => 'success',
																							'sample_collection_date' => $sample_collection_date,
																							'sample_shipped_date' => $sample_shipped_date,
																							'reason_for_test'	=> $test_reason,
																							'tr_lab_work' => $res));
						}else{
							return Response::json(array('status' => 'fail'));
						}
					}
}
