<?php

namespace App\Http\Controllers;

use App\Http\Model\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public $view_path="backend/group/";
    //
    /**
     * display the group created by
     *
     */
    public function list(){
        $groups = Group::where('manager_id', Auth::user()['id'])->orderBy('id','desc')->get();
        return view($this->view_path.'list', compact('groups'));
    }

    /**
     * edit
     * @param $group_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($group_id){
        $group = Group::find($group_id);
        //unnecessary*****************
//        $user_ids = DB::table('group_member')
//                    ->select('user_id')
//                    ->where('group_id',$group_id)
//                    ->get();

        $user_ids = array_column($group->users->toArray(), 'id');
        $candidates = User::whereNotIn('id', $user_ids)->get();
        return view($this->view_path."edit",compact('group','candidates'));
    }

    /**
     *
     * display a task's form
     *
     */
    public function form(){
        return view($this->view_path.'form');
    }


    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $data){
        $data->validate([
            'name' => 'required|string|max:50|unique:mygroup',
        ]);
        Group::create($data->except(['_token']));
        return redirect('group/list');
    }

    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $data){
        $data->validate([
            'name' => 'required|string|max:50',
        ]);
        Group::where('id',$data['id'])->update($data->except(['_token','_method']));
        return redirect('group/list');
    }


    public function removeMember($group_id, $user_id){
        DB::table('group_member')
            ->where('group_id',$group_id)
            ->where('user_id',$user_id)
            ->delete();
        return redirect(route('group.edit',['group_id'=>$group_id]));
    }

    public function addMember($group_id, $user_id){
        DB::table('group_member')
            ->insert([
               'group_id' => $group_id,
               'user_id'  =>$user_id
            ]);
        return redirect(route('group.edit',['group_id'=>$group_id]));
    }

    /**
     *
     * delete an group
     * @param $group_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($group_id){
//        Award::where('id',$award_id)->delete();
//        return redirect('award/list');
    }
}
