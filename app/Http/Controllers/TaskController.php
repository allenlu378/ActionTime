<?php

namespace App\Http\Controllers;


use App\Http\Model\Group;
use App\Http\Model\Task;
use App\Http\Model\Award;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Challenge;


class TaskController extends Controller
{
    public $view_path="backend/task/";
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
     * display the tasks created by user
     *
     */
    public function list(){
        $tasks = Task::where('created_by', Auth::user()['id'])->orderBy('id','desc')->get();
        return view($this->view_path.'list', compact('tasks'));
    }

    /**
     *
     * display a task's form
     *
     */
    public function form(){
        $awards = Award::where('owner',Auth::user()['id'])->orwhere('owner', 0)->orderBy('id','desc')->get();
        return view($this->view_path.'form', compact('awards'));
    }


    public function assign($task_id){
        $task = Task::find($task_id);
        $groups = Group::all();
        return view($this->view_path.'assign', compact('task','groups'));
    }


    public function doAssign(Request $data){
        $data = $data->except('_token');
        if($data['group_id']==-1){
            $re=DB::table('assignment')->where(['task_id'=>$data['task_id'],'user_id'=>-1])->first();
            if($re==null){
                DB::table('assignment')->insert([
                    'task_id'=> $data['task_id'],
                    'user_id'=> -1,
                    'current_value' =>0,
                    'percent' =>0,
                    'sort' => 0,
                    'finish_flag' =>0,
                    'start_time' => now(),
                    'due_time' => $data['due_time'],
                    'acknowledge_flag' => 0,
                ]);
            }else{
                return back()->withErrors(['status'=>['fail to assign because it has been assigned']]);
            }
        }else{
            $group =Group::find($data['group_id']);
            foreach ($group->users as $user){
                $re=DB::table('assignment')->where(['task_id'=>$data['task_id'],'user_id'=>$user['id']])->first();
                if($re==null){
                    DB::table('assignment')->insert([
                        'task_id'=> $data['task_id'],
                        'user_id'=> $user['id'],
                        'current_value' =>0,
                        'percent' =>0,
                        'sort' => 0,
                        'finish_flag' =>0,
                        'start_time' => now(),
                        'due_time' => $data['due_time'],
                        'acknowledge_flag' => 0,
                    ]);
                }else{
                    return back()->withErrors(['status'=>['fail to assign because it has been assigned']]);
                }
            }
        }

        return redirect(route('task/list'))->with('status', 'success to assign !');
    }


    /**
     * @param $task_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($task_id){
        $task = Task::find($task_id);
        $awards = Award::where('owner', Auth::user()['id'])->orwhere('owner', 0)->orderBy('id','desc')->get();
        //dump($task);
        return view($this->view_path.'edit', compact('task','awards'));
    }

    /**
     * update a task
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $data){
        dump($data);
        $data->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'total_value' => 'required|numeric',
        ]);

        $result = Task::where('id',$data['id'])->update($data->except('_token','file_upload'));

        return redirect('task/list');
    }



    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $data){
        $data->validate([
            'name' => 'required|string|max:50|unique:task',
            'description' => 'required|string|max:255',
            'total_value' => 'required|numeric',
        ]);

        //dump($task);
        Task::create($data->except('_token'));
        return redirect('task/list');

    }



    /**
     * delete a task
     *
     */
    public function delete($task_id){

        Task::where('id',$task_id)->delete();
        return redirect('task/list');
    }


    /**
     * pick a task
     * @param $task_id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function pick($task_id){
        //check if it is be picked.
        $user_id = Auth::user()['id'];
        $re=DB::table('assignment')->where(['task_id'=>$task_id,'user_id'=>$user_id])->first();
        if($re==null){
            DB::table('assignment')->insert([
                'task_id'=> $task_id,
                'user_id'=> $user_id,
                'current_value' =>0,
                'percent' =>0,
                'sort' => 0,
                'finish_flag' =>0,
                'start_time' => now(),
            ]);
            return redirect(route('assignment.list'));
        }else{
            return back()->withErrors(['repeat_mistake'=>['you have picked it']]);
        }
    }

}
