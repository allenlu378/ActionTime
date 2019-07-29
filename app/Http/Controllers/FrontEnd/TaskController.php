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
    protected $path = 'frontend/task';
    public function list()
    {
        $error = false;
        $user = Auth::user();
        $tasks = collect(Task::where('created_by', '=', $user['id'])->select('id', 'name', 'description', 'total_value', 'average_workload', 'suggested_times', 'type', 'img')->get())->toArray();
        return view($this->path, compact('tasks', 'user', 'error'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

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
            'name' =>'unique:task',
        ]);

        $info = $request->except('_token');
        if($info['type'] == 'Daily'){$info['type'] = '0';}
        else if($info['type'] == 'Weekly'){$info['type'] = '1';}
        else if($info['type'] == 'Monthly'){$info['type'] = '2';}
        $avg_workload = $info['total_value']/$info['suggested_times'];
        //var_dump($info);
        if(array_key_exists('img', $info)){
            unset($info['img']);
            $img = app('App\Http\Controllers\UtilController')->upload();
            Task::create($info + ['average_workload'=>$avg_workload, 'created_by'=>Auth::user()['id'], 'img'=>$img]);
        }
        else{
            Task::create($info + ['average_workload'=>$avg_workload, 'created_by'=>Auth::user()['id']]);
        }
        return redirect('task/list');
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
    public function edit(Request $request)
    {
        $info = $request->except('_token');
        $cur_name = Task::where('id', '=', $info['id'])->pluck('name')->toArray();
        $info['name'] = $info['name_edit'];
        unset($info['name_edit']);
        if($info['type'] == 'Daily'){
            $info['type'] = 0;
        }
        if($info['type'] == 'Weekly'){
            $info['type'] = 1;
        }
        else{
            $info['type'] = 2;
        }
        if(strcmp($cur_name[0], $info['name']) == 0){
        }
        else{
            $check = Task::where('name', '=', $info['name'])->count();
            if($check != 0){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'name_edit' => ['Task name has already been taken.'],
                ]);
                throw $error;
            }
        }
        if(array_key_exists('img_edit', $info)){
            unset($info['img_edit']);
            $img = app('App\Http\Controllers\UtilController')->upload();
            $info['img'] = $img;
            Task::where('id', '=', $info['id'])->update($info);
        }
        else{
            Task::where('id', '=', $info['id'])->update($info);
        }
        return redirect('task/list');




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
    public function delete(Request $request)
    {
        $info = $request->except('_token');
        Task::where('name', '=', $info['task_name'])->delete();
        return redirect('task/list');
    }

}
