<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public $view_login = "auth/";
    protected $redirectTo = 'frontend/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request){
        $credentials = $request->except('_token');
        $credentials['email'] = $credentials['email_log'];
        $credentials['password'] = $credentials['pass_log'];
        unset($credentials['email_log']);
        unset($credentials['pass_log']);
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('home');
        }
        else{
            $login_invalid =  true;
            return view($this->view_login.'login', compact('login_invalid'));
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
