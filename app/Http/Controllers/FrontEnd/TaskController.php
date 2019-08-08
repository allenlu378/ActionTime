<?php

namespace App\Http\Controllers\frontend;

use App\Http\Model\Challenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Group;
use App\User;
use App\Http\Model\Award;
use Illuminate\Validation\Rule;



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
            'name' =>'unique:task'
        ]);

        $info = $request->except('_token');
        var_dump($info);
        if($info['type'] == 'Daily'){$info['type'] = '0';}
        else if($info['type'] == 'Weekly'){$info['type'] = '1';}
        else if($info['type'] == 'Monthly'){$info['type'] = '2';}
        $avg_workload = $info['total_value']/$info['suggested_times'];
        //var_dump($info);

        unset($info['img']);
        $img = app('App\Http\Controllers\UtilController')->upload('task');
        Task::create($info + ['average_workload'=>$avg_workload, 'created_by'=>Auth::user()['id'], 'img'=>$img]);


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
                    'task_name' => [$cur_name[0]],
                ]);
                throw $error;
            }
        }
        $img_present = Task::where('id', '=', $info['id'])->pluck('img')->toArray();
        if(!(!array_key_exists('img_edit', $info) and $img_present != 'task.png')){
            unset($info['img_edit']);
            $img = app('App\Http\Controllers\UtilController')->upload('task');
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
        $task_id = Task::where('name', $info['task_name'])->pluck('id');
        $challenges = Challenge::where('task_id', $task_id)->count();
        if($challenges != 0){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'task_del' => [$info['task_name']]
            ]);
            throw $error;
        }
        Task::where('name', '=', $info['task_name'])->delete();
        return redirect('task/list');
    }

    protected $assign = 'frontend/assign';

    public function createAssign($name){
        $task = collect(Task::where('name','=', $name)->select('id', 'name', 'description', 'total_value', 'average_workload', 'suggested_times', 'type', 'img')->get())->toArray()[0];
        //var_dump($task);
        $users = collect(User::select('id', 'user_name', 'img')->get())->toArray();
        //var_dump($users);
        $rewards = collect(Award::where('offered_by', '=', Auth::user()['id'])->select('id', 'award_name', 'img')->get())->toArray();
        //var_dump($rewards);
        $id = Auth::user()['id'];
        $groups = collect(Group::where('manager_id', '=', $id)->select('id', 'name')->get())->toArray();
        //var_dump($groups);
        return view($this->assign, compact('task', 'groups', 'users', 'rewards'));

    }


}
