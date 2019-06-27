<?php

namespace App\Http\Controllers;

use App\Http\Model\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AssignmentController extends Controller
{

    public $view_path="backend/assignment/";
    //author:
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
    * show user's task
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */

    public function list(){
        $acked_assignments =Assignment::where('user_id',Auth::user()['id'])->where('acknowledge_flag',1)->get();
        $acking_assignments =Assignment::where('user_id',Auth::user()['id'])->where('acknowledge_flag',0)->get();
        return view($this->view_path.'list', compact('acked_assignments','acking_assignments'));
    }


    public function acknowledge($aid,$c){
        $a = Assignment::find($aid);
        //if it it all assignment, create a new one;
        if($a['used_id']==-1){
            del($a['id']);
            $a['user_id']=Auth::user()['id'];
            $a->save();
        }else{
            $a->acknowledge_flag = $c;
            $a->save();
        }

        return redirect(route('assignment.list'));
    }

    public function schedule($id){
        $assignment = Assignment::find($id);
        $events=[];
        $t=$assignment['start_time'];
        $end_time = $assignment['task']['deadline'];
        for(;$t<$end_time;){
            $event = [];
            $event['title'] = $assignment['task']['name'];
            if($assignment['type']==0){
                $t=date('Y-m-d', strtotime('+1 day', strtotime($t)));
            }else if ($assignment['type']==1){
                $t=date('Y-m-d', strtotime('+1 week', strtotime($t)));
            }else{
                $t=date('Y-m-d', strtotime('+1 month', strtotime($t)));
            }
            $event['start'] = $t;
            $events[]=$event;
        }
        $result=json_encode($events);
        return view($this->view_path."schedule",compact('result'));
    }

}


