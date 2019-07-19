<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bootstrap\ConfigureLogging;
use App\User;

class ProfileController extends Controller
{
    public $view_path="frontend/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view($this->view_path.'profile',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $info = $request->except('_token');
        $user = User::find($id);
        $user->first_name = $info['first_name'];
        $user->last_name = $info['last_name'];
        $user->user_name = $info['user_name'];
        $user->gender = $info['gender'];
        $user->cellphone = $info['cellphone'];
        $user->email = $info['email'];
        $splitAddress = explode(',', $info['address'], 5);
        $user->address = $splitAddress[0];
        $user->city = $splitAddress[1];
        $user->state = $splitAddress[2];
        $user->zip_code = $splitAddress[3];
        $user->country = $splitAddress[4];
        $user->photo = $info['prof_pic'];
        $user->save();
        return view($this->view_path.'home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}