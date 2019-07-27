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
            'member1' => 'required'
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
    public function leave(){
        var_dump('leave');
    }
    public function list()
    {
        $ids = User::pluck('id')->toArray();
        $emails = User::pluck('email')->toArray();
        $pics = User::pluck('img')->toArray();
        //$group_names = Group::where('manager_id', '=', Auth::user()['id'])->pluck('name')->toArray();
        $group_ids = DB::table('group_member')->where('user_id', Auth::user()['id'])->pluck('group_id')->toArray();
        $group_info = collect(DB::table('group_member')->join('user', 'user.id', '=', 'group_member.user_id')->join('user_group', 'user_group.id', '=', 'group_member.group_id')->whereIn('group_id', $group_ids)->select('user_name', 'email', 'group_id', 'name', 'role', 'img')->get())->toArray();
        $num_groups = count($group_ids);
        $group_sizes = [];
        foreach ($group_ids as $id) {
            $group_sizes[$id] = DB::table('group_member')->where('group_id', $id)->count();
        }
        //var_dump($group_sizes);
        $email = Auth::user()['email'];
        //var_dump($email);
        //var_dump($pics);
        return view($this->view_path . 'group', compact('emails', 'pics', 'ids', 'group_info', 'num_groups', 'group_sizes', 'email'));
    }

    /*
     * edit
     * @param $group_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $info = $request->except('_token');
        $cur_name = Group::where('id', '=',$info['id'])->pluck('name')->toArray();
        //var_dump($cur_name[0]);
        //var_dump($info['name']);

        if(strcmp($cur_name[0], $info['name']) == 0){
        }
        else{
            $request->validate([
                'name' => 'unique:user_group',
            ]);
        }
        $request->validate([
            'name' => 'required',
            'member1' => 'required',
        ]);
        Group::where('id', '=',$info['id'])->delete();
        DB::table('group_member')->where('group_id', '=', $info)->delete();
        unset($info['id']);
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
    public function delete(Request $request)
    {
        $info = $request->except('_token')['group_id'];
        $group = Group::find($info);
        $group->delete();
        DB::table('group_member')->where('group_id', '=', $info)->delete();
        //var_dump($group_members);
        return redirect(route('group.list'));
    }
}
