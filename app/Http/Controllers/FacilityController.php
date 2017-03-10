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
class FacilityController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(){
	  $search  = Input::get('search');
		if($search != ""){
			$searchcount = DB::table('facilities')->where('facility_name', '=', $search)->count();
		}else {
			$count = DB::table('facilities')->count();
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

					$facilities = DB::table('facilities')
										->where('facility_name', '=', $search)
										->orderBy('facility_id', 'desc')
										->paginate($showlists);
				}else {
					$facilities = DB::table('facilities')
										->orderBy('facility_id', 'desc')
										->paginate($showlists);
				}

		$labs = Lab::orderBy('lab_id', 'desc')->get();
		return view('facility')
							->with('facilities', $facilities)
							->with('labs', $labs)
							->with('paginator', $facilities);

	  $results->appends(['lists' => $showlists]);
	}


	public function store(){

		$name = Input::get('name');
		$ctcno	=	Input::get('ctcno');
		$level	=	Input::get('level');
		$region	=	Input::get('region');
		$district	=	Input::get('district');
		$lab_id	=	Input::get('lab_id');


		$addfacility = Facility::create(
				array(
					'lab_id'	=>	$lab_id,
					'facility_name'	=>	$name,
					'facility_ctc_no'	=>	$ctcno,
					'facility_level'	=>	$level,
					'facility_region'	=>	$region,
					'facility_district'	=>	$district
				));

				if($addfacility){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

	public function update(){

		$id = Input::get('id');
		$name = Input::get('name');
		$ctcno	=	Input::get('ctcno');
		$level	=	Input::get('level');
		$region	=	Input::get('region');
		$district	=	Input::get('district');
		$lab_id	=	Input::get('lab_id');


		$editfacility = Facility::where('facility_id', $id)->update(
				array(
					'lab_id'	=>	$lab_id,
					'facility_name'	=>	$name,
					'facility_ctc_no'	=>	$ctcno,
					'facility_level'	=>	$level,
					'facility_region'	=>	$region,
					'facility_district'	=>	$district
				));

				if($editfacility){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}


	public function delete(){
		$id = Input::get('id');

		$deletefacility = Facility::where('facility_id', $id)->delete();

		if($deletefacility){
			return Response::json(array('status' => 'success'));
		}else{
			return Response::json(array('status' => 'fail'));
		}
	}

}
