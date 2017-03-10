<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Input;
use Illuminate\Support\Facades\Auth;
use Redirect;
use DB;

class SearchController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getSearchdetails(){
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

		return view('search')
						->with('results', $results)
						->with('paginator', $results);
	}



}
