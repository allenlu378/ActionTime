<?php

namespace App\Http\Controllers;

use App\Http\Model\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public $view_path = "frontend/";
    //

    /**
     * display the group created by
     *
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:user_group',
            'member1' =>'required'
        ]);
        $info = $request->except('_token');
        $group_info = ['name' => $info['name'], 'manager_id' => Auth::user()['id']];
        $group = Group::create($group_info);
        //var_dump($info);
        unset($info['name']);
        $role = 3;
        foreach ($info as $id) {
            if ($id == Auth::user()['id']) {
                $role = 2;
            }
            DB::table('group_member')
                ->insert([
                    'group_id' => $group['id'],
                    'user_id' => $id,
                    'role' => $role
                ]);
            $role = 3;
        }


        return redirect('group/list');
    }

    public function list()
    {
        $ids = User::pluck('id')->toArray();
        $emails = User::pluck('email')->toArray();
        $pics = User::pluck('img')->toArray();
//        $group_names = Group::where('manager_id', '=', Auth::user()['id'])->pluck('name')->toArray();
        $group_ids =  DB::table('group_member')->where('user_id', Auth::user()['id'])->pluck('group_id')->toArray();
        $group_names = collect(DB::table('group_member')->join('user_group', 'user_group.id', '=', 'group_member.group_id')->whereIn('group_id', $group_ids)->select('name')->get())->toArray();
//        $group_info = collect(DB::table('group_member')->whereIn('group_id', $group_ids)->select(['group_id', 'user_id', 'role'])->get())->toArray();
////        $users = collect(User::whereHas('groups', function($q) use($group_ids) {
//            $q->whereIn('group_id', $group_ids);
//        })->get())->toArray();
//        created_ids = collect(DB::table('group_member')->)
        var_dump($group_names);
//
        //var_dump($emails);
        //var_dump($pics);
        //return view($this->view_path . 'group', compact('emails', 'pics', 'ids'));
    }

    /*
     * edit
     * @param $group_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($group_id)
    {
        $group = Group::find($group_id);
        //unnecessary*****************
//        $user_ids = DB::table('group_member')
//                    ->select('user_id')
//                    ->where('group_id',$group_id)
//                    ->get();

        $user_ids = array_column($group->users->toArray(), 'id');
        $candidates = User::whereNotIn('id', $user_ids)->get();
        return view($this->view_path . "edit", compact('group', 'candidates'));
    }

    /**
     *
     * display a tasks form
     *
     */
    public function form()
    {
        return view($this->view_path . 'form');
    }


    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $data)
    {
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
    public function update(Request $data)
    {
        $data->validate([
            'name' => 'required|string|max:50',
        ]);
        Group::where('id', $data['id'])->update($data->except(['_token', '_method']));
        return redirect('group/list');
    }


    public function removeMember($group_id, $user_id)
    {
        DB::table('group_member')
            ->where('group_id', $group_id)
            ->where('user_id', $user_id)
            ->delete();
        return redirect(route('group.edit', ['group_id' => $group_id]));
    }

    public function addMember($group_id, $user_id)
    {
        DB::table('group_member')
            ->insert([
                'group_id' => $group_id,
                'user_id' => $user_id
            ]);
        return redirect(route('group.edit', ['group_id' => $group_id]));
    }

    /**
     *
     * delete an group
     * @param $group_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($group_id)
    {
//        Award::where('id',$award_id)->delete();
//        return redirect('award/list');
    }
}
