<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Model\Assignment;
use App\Http\Model\Award;
use App\User;
use Illuminate\Http\Request;
use App\Http\Model\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $view_path="frontend/";
    public $view_login = "auth/";
    //remove auth check Feb 23th
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function info(){
        return view($this->view_path.'info');
    }
    public function index()
    {
        if (Auth::check())
        {
            return view($this->view_path.'home');
        }
        else
        {
            $login_invalid = false;
            return view($this->view_login.'login', compact('login_invalid'));
        }

    }

    public function login(){
        $login_invalid = false;
        return view($this->view_login.'login', compact('login_invalid'));
    }

}
