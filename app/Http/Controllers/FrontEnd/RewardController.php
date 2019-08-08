<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Model\Challenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Award;

class RewardController extends Controller
{
    public $reward_path = 'frontend/';

    public function list(){
        $user = Auth::user();
        $rewards = collect(Award::where('offered_by', '=', $user['id'])->select('id', 'award_name', 'description', 'total_num', 'remaining_num', 'img')->get())->toArray();
        return view($this->reward_path.'rewards', compact('rewards', 'user'));
    }

    public function store(Request $request){
        $request->validate([
            'award_name' =>'unique:award',
        ]);

        $info = $request->except('_token');
        $remaining = $info['total_num'];
        //var_dump($info);

        unset($info['img']);
        $img = app('App\Http\Controllers\UtilController')->upload('reward');
        Award::create($info + ['remaining_num'=>$remaining, 'offered_by'=>Auth::user()['id'], 'img'=>$img]);

        return redirect('reward/list');
    }
    public function delete(Request $request)
    {

        $info = $request->except('_token');
        $id = Award::where('award_name', '=', $info['award_name'])->pluck('id');
        $challenges = Challenge::where('award_id', $id)->count();
        if($challenges != 0){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'reward_del' => [$info['award_name']]
            ]);
            throw $error;
        }
        Award::where('award_name', '=', $info['award_name'])->delete();
        return redirect('reward/list');
    }
    public function edit(Request $request)
    {
        $info = $request->except('_token');
        $cur_name = Award::where('id', '=', $info['id'])->pluck('award_name')->toArray();
        $info['award_name'] = $info['name_edit'];
        unset($info['name_edit']);
        if($info['remaining_num'] > $info['total_num']){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'remaining_num' => ['Remaining rewards cannot be greater than the total number.'],
                'reward_name' => [$cur_name[0]],
            ]);
            throw $error;
        }
        if(strcmp($cur_name[0], $info['award_name']) == 0){
        }
        else{
            $check = Award::where('award_name', '=', $info['award_name'])->count();
            if($check != 0){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'name_edit' => ['Reward name has already been taken.'],
                    'reward_name' => [$cur_name[0]],
                ]);
                throw $error;
            }
        }
        $img_present = Award::where('id', '=', $info['id'])->pluck('img')->toArray();
        if(!(!array_key_exists('img_edit', $info) and $img_present != 'reward_img.png')){
            unset($info['img_edit']);
            $img = app('App\Http\Controllers\UtilController')->upload('reward');
            $info['img'] = $img;
            Award::where('id', '=', $info['id'])->update($info);
        }
        else{
            Award::where('id', '=', $info['id'])->update($info);
        }
        return redirect('reward/list');




    }
}
