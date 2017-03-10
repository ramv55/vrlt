<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Lab;
use App\User;
use Input;
use Redirect;
use DB;
use Response;
class LabController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(){
	  $search  = Input::get('search');
		if($search != ""){
			$searchcount = DB::table('lab')->where('lab_name', '=', $search)->count();
		}else {
			$count = DB::table('lab')->count();
		}


		$lists  = Input::get('lists');
		if($lists == 'all'){
			$showlists = $count;
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

					$labs = DB::table('lab')
										->where('lab_name', '=', $search)
										->orderBy('lab_id', 'desc')
										->paginate($showlists);
				}else {
					$labs = DB::table('lab')
										->orderBy('lab_id', 'desc')
										->paginate($showlists);
				}


		return view('lab')
						->with('labs', $labs)
						->with('paginator', $labs);

	  $results->appends(['lists' => $showlists]);
	}


	public function store(){

		$labname = Input::get('labname');

		$addlab = Lab::create(
				array(
					'lab_name' => $labname
				));

				if($addlab){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

	public function update(){
		$id = Input::get('id');
		$labname = Input::get('labname');

		$editlab = Lab::where('lab_id', $id)->update(
				array(
					'lab_name' => $labname
				));

				if($editlab){
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

	public function delete(){
		$id = Input::get('id');
		$deletelab = Lab::where('lab_id', $id)->delete();

		if($deletelab){
			return Response::json(array('status' => 'success'));
		}else{
			return Response::json(array('status' => 'fail'));
		}
	}

}
