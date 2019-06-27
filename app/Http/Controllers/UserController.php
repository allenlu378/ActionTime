<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $view_path="backend/user/";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function myprofile()
    {
        return view($this->view_path.'myprofile');
    }

    /**
     * Update user's profile
     *
     */
    public function updateuser( Request $data){
        $user = $data->input();
        unset($user['_token']);
        dump($user);

    }

}
