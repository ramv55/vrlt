<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Input;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLogin(){
  		return view('login');
  	}
  	public function doLogin(){
  		$userdata = array(
  			'username'     => Input::get('user_name'),
  			'password'  => Input::get('password')
  		);
  		if (Auth::attempt($userdata)) {
        if (Auth::check()) {
              User::where('user_id', Auth::id())->update(
                array(
                  'last_login_at' => Date('Y-m-d H:i:s')
                )
              );
              // Authentication passed...
              return redirect()->intended('dashboard');
            }else{
              return view('login')
          						->with('authfailed', 'Authentication Failed.');
            }
          }else{
            return view('login')
                    ->with('authfailed', 'Invalid Username / Password.');
  			//return redirect()->intended('login');
  		}
  	}

    public function doLogout(){
  		Auth::logout();
  		Session::flush();
  		return redirect()->intended('login');
  	}
}
