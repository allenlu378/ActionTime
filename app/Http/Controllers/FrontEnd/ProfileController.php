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
        $cur_name = User::where('id', '=', $id)->pluck('user_name')->toArray()[0];

        $info = $request->except('_token');
        if(strcmp($cur_name, $info['user_name']) == 0){
        }
        else{
            $request->validate([
                'user_name' => 'unique:user',
            ]);
        }
        $user = User::find($id);
        $user->first_name = $info['first_name'];
        $user->last_name = $info['last_name'];
        $user->user_name = $info['user_name'];
        $user->gender = $info['gender'];
        $user->cellphone = $info['cellphone'];
        $user->email = $info['email'];
        $user->address = $info['address'];
        $user->city = $info['city'];
        $user->state = $info['state'];
        $user->zip_code = $info['zip'];
        $user->country = $info['country'];
        if(array_key_exists('img', $info)){
            unset($info['img']);
            $img = app('App\Http\Controllers\UtilController')->upload();
            $user->img = $img;
        }



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
