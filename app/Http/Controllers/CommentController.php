<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Comments;
use App\User;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
class CommentController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}



	public function store(){

		$comment = Input::get('comment');

		$add_comment = Comments::create(
				array(
					'client_id' => Session::get('client_id'),
					'comment' => $comment
				));

				if($add_comment){
					Session::forget('client_id');
					return Response::json(array('status' => 'success'));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

	public function add(){
		$id = Input::get('id');
		$comment = Input::get('comment');

		$add_comment = Comments::create(
				array(
					'client_id' => $id,
					'comment' => $comment
				));

				if($add_comment){
					$res = '';
					$k = 0;
					$previouscomments = DB::select("select * from comments where comments_id != (SELECT MAX(comments_id)) and client_id = '$id' order by comments_id desc");
						foreach ($previouscomments as $prcomments) {
							if($k%2 != 0){
								$rwclass = 'odd';
								$bg = '';
							}else {
								$rwclass = '';
								$bg = 'bgcolor="#f1f2f1"';

							}

					$res .= '<tr>
									<td '.$bg.'>'.date("d/m/Y", strtotime($prcomments->created_at)).'</td>
									<td '.$bg.'>'.$prcomments->comment.'</td>
								</tr>';

					 $k++;
				  }
					return Response::json(array('status' => 'success', 'cm_tbody' => $res));
				}else{
					return Response::json(array('status' => 'fail'));
				}
	}

}
