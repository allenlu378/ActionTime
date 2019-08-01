<?php

namespace App\Http\Controllers\FrontEnd;

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
        if(array_key_exists('img', $info)){
            unset($info['img']);
            $img = app('App\Http\Controllers\UtilController')->upload();
            Award::create($info + ['remaining_num'=>$remaining, 'offered_by'=>Auth::user()['id'], 'img'=>$img]);
        }
        else{
            Award::create($info + ['remaining_num'=>$remaining, 'offered_by'=>Auth::user()['id']]);
        }
        return redirect('reward/list');
    }
}
