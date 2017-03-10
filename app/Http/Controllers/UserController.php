<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Lab;
use App\Models\Facility;
use App\User;
use Input;
use Redirect;
use DB;
use Response;
use Hash;
class UserController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index(){
	  $search  = Input::get('search');
		if($search != ""){
			$searchcount = DB::table('users')->where('username', '=', $search)->count();
		}else {
			$count = DB::table('users')->count();
		}


		$lists  = Input::get('lists');
		if($lists == 'all'){
			$showlists = $count;
		}elseif ($lists != '') {
			$showlists = $lists;
		}else {
			if($search != ""){
					if($searchcount == 0){
						$showlists = 10;
					}else {
						$showlists = $searchcount;
					}

			}else {
				$showlists = 10;
			}

		}

				if($search != ""){

					$users = DB::table('users')
										->where('username', '=', $search)
										->where('role', '!=', 0)
										->orderBy('user_id', 'desc')
										->paginate($showlists);
				}else {
					$users = DB::table('users')
										->where('role', '!=', 0)
										->orderBy('user_id', 'desc')
										->paginate($showlists);
				}

		$labs = Lab::orderBy('lab_id', 'desc')->get();
		$facilities = Facility::orderBy('facility_id', 'desc')->get();

		return view('users')
						->with('users', $users)
						->with('paginator', $users)
						->with('labs', $labs)
						->with('facilities', $facilities);

	  $results->appends(['lists' => $showlists]);
	}


	public function store(){

		$username = Input::get('username');
		$user_role = Input::get('user_role');
		$user_role	=	Input::get('user_role');
		$password	=	Input::get('password');
		$facility	=	Input::get('facility');
		$lab	=	Input::get('lab');
		$region	=	Input::get('region');


		$adduser = User::create(
				array(
					'facility_id'	=>	$facility,
					'lab_id'	=>	$lab,
					'username'	=>	$username,
					'password'	=>	Hash::make($password),
					'region'	=>	$region,
					'role'	=>	$user_role
				));

				if($adduser){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

	public function update(){

		$id = Input::get('id');
		$username = Input::get('username');
		$user_role = Input::get('user_role');
		$user_role	=	Input::get('user_role');
		$password	=	Input::get('password');
		$facility	=	Input::get('facility');
		$lab	=	Input::get('lab');
		$region	=	Input::get('region');


		if($password != ''){
				$updateuser = User::where('user_id', $id)->update(
						array(
							'facility_id'	=>	$facility,
							'lab_id'	=>	$lab,
							'username'	=>	$username,
							'password'	=>	Hash::make($password),
							'region'	=>	$region,
							'role'	=>	$user_role
						));
			}else {
				$updateuser = User::where('user_id', $id)->update(
						array(
							'facility_id'	=>	$facility,
							'lab_id'	=>	$lab,
							'username'	=>	$username,
							'region'	=>	$region,
							'role'	=>	$user_role
						));
			}
				if($updateuser){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}


	public function delete(){
		$id = Input::get('id');

		$deleteuser = User::where('user_id', $id)->delete();

		if($deleteuser){
			return Response::json(array('status' => 'success'));
		}else{
			return Response::json(array('status' => 'fail'));
		}
	}

}
