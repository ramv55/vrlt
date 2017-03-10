<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Input;
use Illuminate\Support\Facades\Auth;
use Redirect;
use DB;
use App\User;
use App\ClientDetails;

class DashboardController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');

	}


	public function showDashboard(){

		if(Auth::user()->role == 2){
				$lab_facility_id = Auth::user()->facility_id;
				$getUserId = User::where('facility_id', $lab_facility_id)
						 ->where('role',1)->first();
				 $userId = @$getUserId->user_id;
	 }

		if(isset($_GET['fname'])){
			$fname  = $_GET['fname'];
		}else{
			$fname = '';
		}
		if(isset($_GET['uid'])){
			$uid  = $_GET['uid'];
		}else{
			$uid  = '';
		}

		if(isset($_GET['dob'])){
			$dob  = $_GET['dob'];
		}else{
			$dob = '';
		}

		if(isset($_GET['phone'])){
			$phone= $_GET['phone'];
		}else{
			$phone = '';
		}

		if(isset($_GET['alert'])){
			$alert= $_GET['alert'];
		}else{
			$alert = '';
		}


		//********************* Alerts starts here *************************************

							$get_client_on_art_ids =	DB::select("select * from (select * from treatment order by treatment_id desc) t group by t.client_id");
									$ids = array('');
									foreach ($get_client_on_art_ids as $res) {
											$ids[] = $res->treatment_id;
									}



										$client_on_art_tb = DB::table('client_details');

										if(Auth::user()->role == 1){
											$client_on_art_tb->where('client_details.created_by', Auth::id());
										}else if(Auth::user()->role == 2){
												$client_on_art_tb->where('client_details.created_by', $userId);
										}
												$client_on_art = $client_on_art_tb->join('treatment', 'client_details.client_id', '=', 'treatment.client_id')
												->select('treatment.treatment_id','client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
												->whereIn('treatment.treatment_id', $ids)
												->whereIn('treatment.art_status', array('Not Yet Initiated', ''))->count();


												$client_enrolled_tb = DB::table('client_details');
													if(Auth::user()->role == 1){
														$client_enrolled_tb->where('client_details.created_by', Auth::id());
													}else if(Auth::user()->role == 2){
															$client_enrolled_tb->where('client_details.created_by', $userId);
													}
														$client_enrolled = $client_enrolled_tb->select('client_details.pregnant_feeding','client_details.currently_enrolled_in')
														->where('client_details.pregnant_feeding', '=', 1)
														->whereIn('client_details.currently_enrolled_in', array('', 0))->count();


							$get_lab_ids =	DB::select("select * from (select * from lab_results order by lab_results_id desc) l group by l.client_id");
									$lids = array('');
									$lb_ids = array('');
									foreach ($get_lab_ids as $res) {
											$lids[] = $res->lab_results_id;
											$clIds[] = $res->client_id;
											$lastresult  = DB::select("select * from (select * from lab_results where client_id = '".$res->client_id."'  order by lab_results_id desc limit 1,1) t group by t.client_id");
											foreach($lastresult as $lbr){
												if($lbr->hiv_viral_load_results != ''){
													$lb_ids[] = $lbr -> lab_results_id;
												}
											}
									}


									//Sample Not Rec'd at Lab
									$date = new \DateTime;
									$date->modify('-11 DAY');
									$formatted_date = $date->format('m/d/Y');

									 $count_sample_recd_lab_tb = DB::table('order_lab_work');
									 if(Auth::user()->role == 1){
										 $count_sample_recd_lab_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
											 $count_sample_recd_lab_tb->where('client_details.created_by', $userId);
									 }
											$count_sample_recd_lab = $count_sample_recd_lab_tb->join('lab_results', 'lab_results.client_id', '=', 'order_lab_work.client_id')
											->join('client_details', 'client_details.client_id', '=', 'order_lab_work.client_id')
											->select('order_lab_work.order_lab_work_id')
											->whereIn('lab_results.lab_results_id', $lids)
											->where('order_lab_work.sample_shipped_date', '<=', $formatted_date)
											->where('lab_results.test_received_date', '=', '')->count();


											$count_delayed_lab_results_tb = DB::table('lab_results');
											if(Auth::user()->role == 1){
											 $count_delayed_lab_results_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
												 $count_delayed_lab_results_tb->where('client_details.created_by', $userId);
										 }

										 $count_delayed_lab_results = $count_delayed_lab_results_tb->join('client_details', 'client_details.client_id', '=', 'lab_results.client_id')
												 ->select('*')
												 ->whereIn('lab_results_id', $lids)
												 ->where('test_received_date', '<=', $formatted_date)
												 ->where('test_received_date', '!=', '')
												 ->where('hiv_viral_load_results', '=', '')->count();

												 $count_critical_tb = DB::table('lab_results');
			 										if(Auth::user()->role == 1){
			 										 		$count_critical_tb->where('client_details.created_by', Auth::id());
			 									 	}else if(Auth::user()->role == 2){
			 											 $count_critical_tb->where('client_details.created_by', $userId);
			 									 	}

											$count_critical_tb = $count_critical_tb->join('client_details', 			    'client_details.client_id', '=', 'lab_results.client_id')
		 												 ->select('*')
														 ->whereIn('lab_results.lab_results_id', $lids)
		 												 ->where('lab_results.hiv_viral_load_results', '>=', 1000)
														 ->where('client_details.client_counselled', 0)->count();



											$count_raising_viral_load_tb = DB::table('lab_results');
											if(Auth::user()->role == 1){
													$count_raising_viral_load_tb->where('client_details.created_by', Auth::id());
											}else if(Auth::user()->role == 2){
												 $count_raising_viral_load_tb->where('client_details.created_by', $userId);
											}

											$count_raising_viral_load_tb = $count_raising_viral_load_tb->join('client_details', 			    'client_details.client_id', '=', 'lab_results.client_id')
		 												 ->select('*')
														 ->whereIn('lab_results.lab_results_id', $lb_ids)->get();

												$i = 0;
												$co = 0;
												foreach ($count_raising_viral_load_tb as $value) {

														//$value->hiv_viral_load_results
														$recent_raising_viral_load_tb = DB::table('lab_results');
														if(Auth::user()->role == 1){
																$recent_raising_viral_load_tb->where('client_details.created_by', Auth::id());
														}else if(Auth::user()->role == 2){
															 $recent_raising_viral_load_tb->where('client_details.created_by', $userId);
														}

														$recent_raising_viral_load_tb = $recent_raising_viral_load_tb->join('client_details', 			    'client_details.client_id', '=', 'lab_results.client_id')
					 												 ->select('*')
																	 ->where('lab_results.hiv_viral_load_results', '!=', '')
																	  ->whereIn('lab_results.lab_results_id', $lids)
																	 ->orderBy('lab_results.lab_results_id')->get();



															 $recent_result = $recent_raising_viral_load_tb[$i]->hiv_viral_load_results;

															if($recent_result >= ($value->hiv_viral_load_results * 1.25)){
																$co += 1;
															}
												 $i++;
												}

										$count_critical_increase_result = $co;

										$get_order_lab_ids =	DB::select("select * from (select * from order_lab_work order by order_lab_work_id desc) o group by o.client_id");
										$oids = array('');
										foreach($get_order_lab_ids as $oid){
											$oids[] = $oid -> order_lab_work_id;

										}


										$count_missed_viral_load_tb = DB::table('order_lab_work');
										if(Auth::user()->role == 1){
												$count_missed_viral_load_tb->where('client_details.created_by', Auth::id());
										}else if(Auth::user()->role == 2){
											 $count_missed_viral_load_tb->where('client_details.created_by', $userId);
										}

								 $count_missed_viral_load_tb = $count_missed_viral_load_tb->join('client_details', 			 'client_details.client_id', '=', 'order_lab_work.client_id')
									 ->join('discharge', 'discharge.client_id', '=', 'order_lab_work.client_id')
												->select('*')
												->whereIn('order_lab_work.order_lab_work_id', $oids)
												->where('order_lab_work.sample_collected_date', '>=',  DB::raw('order_lab_work.nexttestdate'))
												->orwhere('order_lab_work.sample_collected_date', '>=',  DB::raw('discharge.date_of_discharge'))
												->where('discharge.client_discharged', 1)->count();




						//********************* Alerts ends here *************************************

						if($fname != '' && $uid != '' && $dob != '' && $phone != ''){

							$uid1 = substr($uid, 0, 8);
					    $uid2 = substr($uid, 8, 6);

					    $uidsearch = $uid1.'-'.$uid2;

							$count_tb =	DB::table('facilities');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }
							$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
							  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
							                ->select('*')
															->where('facilities.facility_name','=', $fname)
															->where('client_details.dob','=', $dob)
															->where('client_details.phone','=', $phone)
															->where('client_details.client_uid','=', $uidsearch)
															->count();



								$lists  = Input::get('lists');
								if($lists == 'all'){
									$showlists = $count;
								}elseif ($lists != '') {
									$showlists = $lists;
								}else {
									$showlists = 10;
								}

								$results_tb = DB::table('facilities');
                if(Auth::user()->role == 1){
                   $results_tb->where('client_details.created_by', Auth::id());
                 }else if(Auth::user()->role == 2){
                   $results_tb->where('client_details.created_by', $userId);
                 }
                    $results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
                      ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
                      ->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
                      ->where('facilities.facility_name','=', $fname)
											->where('client_details.dob','=', $dob)
											->where('client_details.phone','=', $phone)
											->where('client_details.client_uid','=', $uidsearch)
                        ->orderBy('client_details.client_id', 'desc')
                        ->paginate($showlists);

			  				$results->appends(['fname' => $fname]);
			  				$results->appends(['dob' => $dob]);
			  				$results->appends(['uid' => $uid]);
			  				$results->appends(['phone' => $phone]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($fname != '' && $uid != '' && $dob != ''){

							$uid1 = substr($uid, 0, 8);
					    $uid2 = substr($uid, 8, 6);

					    $uidsearch = $uid1.'-'.$uid2;

							$count_tb =	DB::table('facilities');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }
							$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
							  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
							                ->select('*')
															->where('facilities.facility_name','=', $fname)
															->where('client_details.dob','=', $dob)
															->where('client_details.client_uid','=', $uidsearch)
															->count();



								$lists  = Input::get('lists');
								if($lists == 'all'){
									$showlists = $count;
								}elseif ($lists != '') {
									$showlists = $lists;
								}else {
									$showlists = 10;
								}

								$results_tb = DB::table('facilities');
                if(Auth::user()->role == 1){
                   $results_tb->where('client_details.created_by', Auth::id());
                 }else if(Auth::user()->role == 2){
                   $results_tb->where('client_details.created_by', $userId);
                 }
                    $results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
                      ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
                      ->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
                      ->where('facilities.facility_name','=', $fname)
											->where('client_details.dob','=', $dob)
											->where('client_details.client_uid','=', $uidsearch)
                        ->orderBy('client_details.client_id', 'desc')
                        ->paginate($showlists);


			  				$results->appends(['fname' => $fname]);
			  				$results->appends(['dob' => $dob]);
			  				$results->appends(['uid' => $uid]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($fname != '' && $uid != '' && $phone != ''){

							$uid1 = substr($uid, 0, 8);
					    $uid2 = substr($uid, 8, 6);

					    $uidsearch = $uid1.'-'.$uid2;

							$count_tb =	DB::table('facilities');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }
							$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
							  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
							                ->select('*')
															->where('facilities.facility_name','=', $fname)
															->where('client_details.phone','=', $phone)
															->where('client_details.client_uid','=', $uidsearch)
															->count();



								$lists  = Input::get('lists');
								if($lists == 'all'){
									$showlists = $count;
								}elseif ($lists != '') {
									$showlists = $lists;
								}else {
									$showlists = 10;
								}

								$results_tb = DB::table('facilities');
                if(Auth::user()->role == 1){
                   $results_tb->where('client_details.created_by', Auth::id());
                 }else if(Auth::user()->role == 2){
                   $results_tb->where('client_details.created_by', $userId);
                 }
                    $results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
                      ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
                      ->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
                      ->where('facilities.facility_name','=', $fname)
											->where('client_details.phone','=', $phone)
											->where('client_details.client_uid','=', $uidsearch)
                        ->orderBy('client_details.client_id', 'desc')
                        ->paginate($showlists);


			  				$results->appends(['fname' => $fname]);
			  				$results->appends(['phone' => $phone]);
			  				$results->appends(['uid' => $uid]);
								$results->appends(['lists' => $showlists]);
			  		}elseif($fname != '' && $phone != '' && $dob != ''){

							$count_tb =	DB::table('facilities');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }
							$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
							  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
							                ->select('*')
															->where('facilities.facility_name','=', $fname)
															->where('client_details.phone','=', $phone)
															->where('client_details.dob','=', $dob)
															->count();



								$lists  = Input::get('lists');
								if($lists == 'all'){
									$showlists = $count;
								}elseif ($lists != '') {
									$showlists = $lists;
								}else {
									$showlists = 10;
								}

								$results_tb = DB::table('facilities');
                if(Auth::user()->role == 1){
                   $results_tb->where('client_details.created_by', Auth::id());
                 }else if(Auth::user()->role == 2){
                   $results_tb->where('client_details.created_by', $userId);
                 }
                    $results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
                      ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
                      ->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
                      ->where('facilities.facility_name','=', $fname)
											->where('client_details.phone','=', $phone)
											->where('client_details.dob','=', $dob)
                        ->orderBy('client_details.client_id', 'desc')
                        ->paginate($showlists);


			  				$results->appends(['fname' => $fname]);
			  				$results->appends(['phone' => $phone]);
			  				$results->appends(['dob' => $dob]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($uid != '' && $phone != '' && $dob != ''){

							$uid1 = substr($uid, 0, 8);
					    $uid2 = substr($uid, 8, 6);

					    $uidsearch = $uid1.'-'.$uid2;

							$count_tb =	DB::table('client_details');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }

							$count	=	$count_tb->select('*')->where('client_details.client_uid','=', $uidsearch)
															->where('client_details.dob','=', $dob)
															->where('client_details.phone', '=', $phone)->count();

							$lists  = Input::get('lists');
							if($lists == 'all'){
								$showlists = $count;
							}elseif ($lists != '') {
								$showlists = $lists;
							}else {
								$showlists = 10;
							}


						$results = DB::table('client_details')
									->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
									->where('client_details.client_uid','=', $uid)
									->where('client_details.dob','=', $dob)
									->where('client_details.phone', '=', $phone)
										->orderBy('client_details.client_id', 'desc')
										->paginate($showlists);

			  				$results->appends(['uid' => $uid]);
			  				$results->appends(['phone' => $phone]);
			  				$results->appends(['dob' => $dob]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($fname != '' && $uid != ''){

							$uid1 = substr($uid, 0, 8);
					    $uid2 = substr($uid, 8, 6);

					    $uidsearch = $uid1.'-'.$uid2;

							$count_tb =	DB::table('facilities');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }
							$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
							  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
							                ->select('*')
															->where('facilities.facility_name','=', $fname)
															->where('client_details.client_uid','=', $uidsearch)->count();

								$lists  = Input::get('lists');
								if($lists == 'all'){
									$showlists = $count;
								}elseif ($lists != '') {
									$showlists = $lists;
								}else {
									$showlists = 10;
								}

								$results_tb = DB::table('facilities');
								if(Auth::user()->role == 1){
									 $results_tb->where('client_details.created_by', Auth::id());
								 }else if(Auth::user()->role == 2){
									 $results_tb->where('client_details.created_by', $userId);
								 }

							$results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
								->join('client_details', 'users.user_id', '=', 'client_details.created_by')
								->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
								->where('facilities.facility_name','=', $fname)
								->where('client_details.client_uid','=', $uidsearch)
								->orderBy('client_details.client_id', 'desc')
								->paginate($showlists);


			  				$results->appends(['uid' => $uid]);
			  				$results->appends(['fname' => $fname]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($fname != '' && $dob != ''){

							$count_tb =	DB::table('facilities');
							if(Auth::user()->role == 1){
							   $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
							   $count_tb->where('client_details.created_by', $userId);
							 }
							$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
							  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
							                ->select('*')
															->where('facilities.facility_name','=', $fname)
															->where('client_details.dob','=', $dob)->count();

								$lists  = Input::get('lists');
								if($lists == 'all'){
									$showlists = $count;
								}elseif ($lists != '') {
									$showlists = $lists;
								}else {
									$showlists = 10;
								}

								$results_tb = DB::table('facilities');
								if(Auth::user()->role == 1){
									 $results_tb->where('client_details.created_by', Auth::id());
								 }else if(Auth::user()->role == 2){
									 $results_tb->where('client_details.created_by', $userId);
								 }

							$results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
								->join('client_details', 'users.user_id', '=', 'client_details.created_by')
								->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
								->where('facilities.facility_name','=', $fname)
								->where('client_details.dob','=', $dob)
								->orderBy('client_details.client_id', 'desc')
								->paginate($showlists);

			  				$results->appends(['dob' => $dob]);
			  				$results->appends(['fname' => $fname]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($dob != '' && $uid != ''){
										$uid1 = substr($uid, 0, 8);
										$uid2 = substr($uid, 8, 6);

										$uidsearch = $uid1.'-'.$uid2;

										$count_tb =	DB::table('client_details');
										if(Auth::user()->role == 1){
										   $count_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
										   $count_tb->where('client_details.created_by', $userId);
										 }

											$count = $count_tb->select('*')->where('client_details.client_uid','=', $uidsearch)
																		->where('client_details.dob','=', $dob)->count();

										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}


									$results_tb = DB::table('client_details');
									if(Auth::user()->role == 1){
										 $results_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
										 $results_tb->where('client_details.created_by', $userId);
									 }

										$results =  $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
												->where('client_details.client_uid','=', $uidsearch)
												->where('client_details.dob','=', $dob)
													->orderBy('client_details.client_id', 'desc')
													->paginate($showlists);

			  				$results->appends(['uid' => $uid]);
			  				$results->appends(['dob' => $dob]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($phone != '' && $uid != ''){
										$uid1 = substr($uid, 0, 8);
									 	$uid2 = substr($uid, 8, 6);

									 	$uidsearch = $uid1.'-'.$uid2;

										$count_tb =	DB::table('client_details');
										if(Auth::user()->role == 1){
										   $count_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
										   $count_tb->where('client_details.created_by', $userId);
										 }

										$count = $count_tb->select('*')->where('client_details.client_uid','=', $uidsearch)
																		->where('client_details.phone','=', $phone)->count();

										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}


									$results_tb = DB::table('client_details');
									if(Auth::user()->role == 1){
										 $results_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
										 $results_tb->where('client_details.created_by', $userId);
									 }

									$results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
												->where('client_details.client_uid','=', $uidsearch)
												->where('client_details.phone','=', $phone)
													->orderBy('client_details.client_id', 'desc')
													->paginate($showlists);

			  				$results->appends(['uid' => $uid]);
			  				$results->appends(['phone' => $phone]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($phone != '' && $fname != ''){

									$count_tb =	DB::table('facilities');
									if(Auth::user()->role == 1){
										 $count_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
										 $count_tb->where('client_details.created_by', $userId);
									 }
										$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
										  ->join('client_details', 'users.user_id', '=', 'client_details.created_by')
										                ->select('*')
																		->where('facilities.facility_name','=', $fname)
																		->where('client_details.phone','=', $phone)->count();

										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}

										$results_tb = DB::table('facilities');
										if(Auth::user()->role == 1){
											 $results_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
											 $results_tb->where('client_details.created_by', $userId);
										 }
												$results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
													->join('client_details', 'users.user_id', '=', 'client_details.created_by')
													->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
													->where('facilities.facility_name','=', $fname)
													->where('client_details.phone','=', $phone)
														->orderBy('client_details.client_id', 'desc')
														->paginate($showlists);

								$results->appends(['fname' => $fname]);
			  				$results->appends(['phone' => $phone]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($phone != '' && $dob != ''){

										$count_tb =	DB::table('client_details');
										if(Auth::user()->role == 1){
											 $count_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
											 $count_tb->where('client_details.created_by', $userId);
										 }

										$count = $count_tb->select('*')->where('client_details.dob','=', $dob)
																		->where('client_details.phone','=', $phone)->count();

										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}


									$results_tb = DB::table('client_details');
									if(Auth::user()->role == 1){
										 $results_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
										 $results_tb->where('client_details.created_by', $userId);
									 }
												$results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
												->where('client_details.dob','=', $dob)
												->where('client_details.phone','=', $phone)
													->orderBy('client_details.client_id', 'desc')
													->paginate($showlists);

			  				$results->appends(['dob' => $dob]);
			  				$results->appends(['phone' => $phone]);
								$results->appends(['lists' => $showlists]);
			  		}elseif($fname != ''){

										$count_tb =	DB::table('facilities');
										if(Auth::user()->role == 1){
											 $count_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
											 $count_tb->where('client_details.created_by', $userId);
										 }
										$count = $count_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
											->join('client_details', 'users.user_id', '=', 'client_details.created_by')
																		->select('*')->where('facilities.facility_name','=', $fname)->count();


										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}

										$results_tb = DB::table('facilities');
										if(Auth::user()->role == 1){
											 $results_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
											 $results_tb->where('client_details.created_by', $userId);
										 }
												$results = $results_tb->join('users', 'users.facility_id', '=', 'facilities.facility_id')
													->join('client_details', 'users.user_id', '=', 'client_details.created_by')
													->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
													->where('facilities.facility_name','=', $fname)
														->orderBy('client_details.client_id', 'desc')
													  ->paginate($showlists);

			  				$results->appends(['fname' => $fname]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($uid != ''){

										$uid1 = substr($uid, 0, 8);
										$uid2 = substr($uid, 8, 6);

										$uidsearch = $uid1.'-'.$uid2;

										$count_tb =	DB::table('client_details');
										if(Auth::user()->role == 1){
											 $count_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
											 $count_tb->where('client_details.created_by', $userId);
										 }
										$count = $count_tb->select('*')->where('client_details.client_uid','=', $uidsearch)->count();

										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}

								$results_tb = DB::table('client_details');
								if(Auth::user()->role == 1){
									 $results_tb->where('client_details.created_by', Auth::id());
								 }else if(Auth::user()->role == 2){
									 $results_tb->where('client_details.created_by', $userId);
								 }
											$results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
											->where('client_details.client_uid','=', $uidsearch)
												->orderBy('client_details.client_id', 'desc')
												->paginate($showlists);

			  				$results->appends(['uid' => $uid]);
								$results->appends(['lists' => $showlists]);
			  		}elseif($dob != ''){

										$count_tb =	DB::table('client_details');

										if(Auth::user()->role == 1){
											 $count_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
											 $count_tb->where('client_details.created_by', $userId);
										 }

										$count = $count_tb->select('*')->where('client_details.dob','=', $dob)->count();

										$lists  = Input::get('lists');
										if($lists == 'all'){
											$showlists = $count;
										}elseif ($lists != '') {
											$showlists = $lists;
										}else {
											$showlists = 10;
										}


									$results_tb = DB::table('client_details');
									if(Auth::user()->role == 1){
										 $results_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
										 $results_tb->where('client_details.created_by', $userId);
									 }
												$results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
												->where('client_details.dob','=', $dob)
													->orderBy('client_details.client_id', 'desc')
													->paginate($showlists);

			  				$results->appends(['dob' => $dob]);
								$results->appends(['lists' => $showlists]);

			  		}elseif($phone != ''){
							$count_tb =	DB::table('client_details');
							if(Auth::user()->role == 1){
								 $count_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
								 $count_tb->where('client_details.created_by', $userId);
							 }

							$count = $count_tb->select('*')->where('client_details.phone','=', $phone)->count();

							$lists  = Input::get('lists');
							if($lists == 'all'){
								$showlists = $count;
							}elseif ($lists != '') {
								$showlists = $lists;
							}else {
								$showlists = 10;
							}


							$results_tb = DB::table('client_details');
							if(Auth::user()->role == 1){
								 $results_tb->where('client_details.created_by', Auth::id());
							 }else if(Auth::user()->role == 2){
								 $results_tb->where('client_details.created_by', $userId);
							 }
										$results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
										->where('client_details.phone','=', $phone)
											->orderBy('client_details.client_id', 'desc')
											->paginate($showlists);

			  					$results->appends(['phone' => $phone]);
									$results->appends(['alert' => $alert]);
									$results->appends(['lists' => $showlists]);
			  		}elseif($alert != ''){

							$lists  = Input::get('lists');
							if($lists == 'all'){
								if($alert == "clientonart"){
									$showlists = $client_on_art;
								}elseif ($alert == "clientenroll") {
									$showlists = $client_enrolled;
								}elseif ($alert == "samplereceived") {
									$showlists = $count_sample_recd_lab;
								}elseif ($alert == "delayedlabresults") {
									$showlists = $count_delayed_lab_results;
								}elseif ($alert == "criticalviralload") {
									$showlists = $count_critical_tb;
								}elseif ($alert == "raisingviralload") {
									$showlists = $count_critical_increase_result;
								}elseif ($alert == "missedviralloadtest") {
									$showlists = $count_missed_viral_load_tb;
								}
							}elseif ($lists != '') {
								$showlists = $lists;
							}else {
								$showlists = 10;
							}

							if($alert == "clientonart"){

												$results_tb = DB::table('client_details');

												if(Auth::user()->role == 1){
													 $results_tb->where('client_details.created_by', Auth::id());
												 }else if(Auth::user()->role == 2){
													 $results_tb->where('client_details.created_by', $userId);
												 }

													$results = $results_tb->join('treatment', 'client_details.client_id', '=', 'treatment.client_id')
													->select('treatment.treatment_id','client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
													->whereIn('treatment.treatment_id', $ids)
													->where('treatment.art_status', '=', 'Not Yet Initiated')
													->orderBy('treatment.created_at', 'desc')
													->paginate($showlists);

							}elseif ($alert == "clientenroll") {

												$results_tb = DB::table('client_details');

												if(Auth::user()->role == 1){
													 $results_tb->where('client_details.created_by', Auth::id());
												 }else if(Auth::user()->role == 2){
													 $results_tb->where('client_details.created_by', $userId);
												 }

													$results = $results_tb->select('*')
													->where('client_details.pregnant_feeding', '=', 1)
													->whereIn('client_details.currently_enrolled_in', array('', 0))
															->paginate($showlists);

							}elseif ($alert == "samplereceived") {

									$results_tb = DB::table('client_details');

									if(Auth::user()->role == 1){
										 $results_tb->where('client_details.created_by', Auth::id());
									 }else if(Auth::user()->role == 2){
										 $results_tb->where('client_details.created_by', $userId);
									 }

										$results = $results_tb->join('lab_results', 'lab_results.client_id', '=', 'client_details.client_id')
										->join('order_lab_work', 'order_lab_work.client_id', '=', 'client_details.client_id')
	 									->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
										->whereIn('lab_results.lab_results_id', $lids)
	 									->where('order_lab_work.sample_shipped_date', '<=', $formatted_date)
	 									->where('lab_results.test_received_date', '=', '')->paginate($showlists);

							}elseif ($alert == "delayedlabresults") {

									 $results_tb = DB::table('client_details');

 									if(Auth::user()->role == 1){
 										 $results_tb->where('client_details.created_by', Auth::id());
 									 }else if(Auth::user()->role == 2){
 										 $results_tb->where('client_details.created_by', $userId);
 									 }

 										$results = $results_tb->join('lab_results', 'lab_results.client_id', '=', 'client_details.client_id')
											 ->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
											 ->whereIn('lab_results.lab_results_id', $lids)
											 ->where('lab_results.test_received_date', '<=', $formatted_date)
											 ->where('lab_results.test_received_date', '!=', '')
											 ->where('lab_results.hiv_viral_load_results', '=', '')->paginate($showlists);

							}elseif ($alert == "criticalviralload") {
										$results_tb = DB::table('lab_results');
										 if(Auth::user()->role == 1){
												 $results_tb->where('client_details.created_by', Auth::id());
										 }else if(Auth::user()->role == 2){
												$results_tb->where('client_details.created_by', $userId);
										 }

									 $results = $results_tb->join('client_details','client_details.client_id', '=', 'lab_results.client_id')
													->select('*')
													->whereIn('lab_results.lab_results_id', $lids)
													->where('lab_results.hiv_viral_load_results', '>=', 1000)
													->where('client_details.client_counselled', 0)->paginate($showlists);
							}elseif ($alert == "raisingviralload") {
										$count_raising_viral_load_tb = DB::table('lab_results');
										if(Auth::user()->role == 1){
												$count_raising_viral_load_tb->where('client_details.created_by', Auth::id());
										}else if(Auth::user()->role == 2){
											 $count_raising_viral_load_tb->where('client_details.created_by', $userId);
										}

										$count_raising_viral_load_tb = $count_raising_viral_load_tb->join('client_details', 			'client_details.client_id', '=', 'lab_results.client_id')
													 ->select('*')
													 ->whereIn('lab_results.lab_results_id', $lb_ids)->get();
											$i = 0;
											$co = 0;
											foreach ($count_raising_viral_load_tb as $value) {

													//$value->hiv_viral_load_results
													$recent_raising_viral_load_tb = DB::table('lab_results');
													if(Auth::user()->role == 1){
															$recent_raising_viral_load_tb->where('client_details.created_by', Auth::id());
													}else if(Auth::user()->role == 2){
														 $recent_raising_viral_load_tb->where('client_details.created_by', $userId);
													}

													$recent_raising_viral_load_tb = $recent_raising_viral_load_tb->join('client_details', 			    'client_details.client_id', '=', 'lab_results.client_id')
																 ->select('*')
																 ->where('lab_results.hiv_viral_load_results', '!=', '')
																	->whereIn('lab_results.lab_results_id', $lids)
																 ->orderBy('lab_results.lab_results_id')->get();



														 $recent_result = $recent_raising_viral_load_tb[$i]->hiv_viral_load_results;

														if($recent_result >= ($value->hiv_viral_load_results * 1.25)){
															$ids[] = $recent_raising_viral_load_tb[$i]->client_id;
														}
											 $i++;
											}
											$results_tb = DB::table('client_details');

											if(Auth::user()->role == 1){
												 $results_tb->where('client_details.created_by', Auth::id());
											 }else if(Auth::user()->role == 2){
												 $results_tb->where('client_details.created_by', $userId);
											 }

											$results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
											->whereIn('client_details.client_id', $ids)
												->orderBy('client_details.client_id', 'desc')
												->paginate($showlists);

							}elseif ($alert == "missedviralloadtest") {
									$results_tb = DB::table('order_lab_work');
									if(Auth::user()->role == 1){
											$results_tb->where('client_details.created_by', Auth::id());
									}else if(Auth::user()->role == 2){
										 $results_tb->where('client_details.created_by', $userId);
									}

									$results = $results_tb->join('client_details', 			 'client_details.client_id', '=', 'order_lab_work.client_id')
									->join('discharge', 'discharge.client_id', '=', 'order_lab_work.client_id')
											->select('*')
											->whereIn('order_lab_work.order_lab_work_id', $oids)
											->where('order_lab_work.sample_collected_date', '>=',  DB::raw('order_lab_work.nexttestdate'))
											->orwhere('order_lab_work.sample_collected_date', '>=',  DB::raw('discharge.date_of_discharge'))
											->where('discharge.client_discharged', 1)->paginate($showlists);
							}


			  					$results->appends(['alert' => $alert]);
									$results->appends(['lists' => $showlists]);
			  		}else{
							$count =	DB::table('client_details')
															->select('*')->count();
							$lists  = Input::get('lists');

							if($lists == 'all'){
								$showlists = $count;
							}elseif ($lists != '') {
								$showlists = $lists;
							}else {
								$showlists = 10;
							}


											 $results_tb = DB::table('client_details');

											 if(Auth::user()->role == 1){
													$results_tb->where('client_details.created_by', Auth::id());
												}else if(Auth::user()->role == 2){
													$results_tb->where('client_details.created_by', $userId);
												}

											 $results = $results_tb->select('client_details.created_at', 'client_details.client_id', 'client_details.client_uid','client_details.gender')
												 ->orderBy('client_details.client_id', 'desc')
												 ->paginate($showlists);

						}


		return view('dashboard')
						->with('results', $results)
						->with('paginator', $results)
						->with('client_on_art', $client_on_art)
						->with('client_enrolled', $client_enrolled)
						->with('count_sample_recd_lab', $count_sample_recd_lab)
						->with('count_delayed_lab_results', $count_delayed_lab_results)
						->with('critical_viral_load', $count_critical_tb)
						->with('raising_viral_load', $count_critical_increase_result)
						->with('missed_viral_load_test',$count_missed_viral_load_tb);

	}

}
