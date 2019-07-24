<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $path = 'frontend/task';
    public function create()
    {
        return view($this->path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required',
        ]);
        $info = $request->except('_token');
        if($info['type'] == 'Daily'){$info['type'] = '0';}
        else if($info['type'] == 'Weekly'){$info['type'] = '1';}
        else if($info['type'] == 'Monthly'){$info['type'] = '2';}
        $avg_workload = $info['total_value']/$info['suggested_times'];
        //var_dump($info);
        unset($info['img']);
        $img = app('App\Http\Controllers\UtilController')->upload();
        Task::create($info + ['average_workload'=>$avg_workload, 'created_by'=>Auth::user()['id'], 'img'=>$img]);
        return view($this->path);

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
        //
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
