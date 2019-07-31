<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\ChallengeProgress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChallengeProgressController extends Controller
{
    public function getCurrentChallenges(Request $request)
    {
        $username = Auth::user();

        $current_challenges = "";

        $challenges = ChallengeProgress::with('Challenge');
        if($username)
        {
            $current_challenges = $challenges->where('challenge_progress.user_id', Auth::user()['id'])->
            where('finish_flag','=',0);

            if($request->input('id') > 0)
            {
                $current_challenges = $current_challenges->where('challenge_progress.id', '<', $request->input('id'))->orderByDesc('id')->
                limit(3)->select('*')->get()->toJson();
            }
            else
            {

                $current_challenges = $current_challenges->orderByDesc('challenge_progress.id')->limit(3)->select('*')->get()->toJson();
            }
        }
        else
        {
            $current_challenges = "not logged in";
        }
        return $current_challenges;
    }

    public function getCompletedChallenges(Request $request)
    {
        $completed_challenges = "";

        $username = Auth::user();

        $challenges = ChallengeProgress::with('Challenge');

        if($username)
        {
            $all_user_challenges  = $challenges->where('user_id', Auth::user()['id']);
            $completed_challenges = $all_user_challenges->where(function ($query) {
                $query->where('finish_flag','=',-1)->orWhere('finish_flag','=',1);
            });

            if($request->input('id') > 0)
            {
                $completed_challenges = $completed_challenges->where('id', '<', $request->input('id'))->orderByDesc('challenge_progress.id')->
                limit(3)->select('*')->get()->toJson();
            }
            else
            {

                $completed_challenges = $completed_challenges->orderByDesc('challenge_progress.id')->limit(3)->select('*')->get()->toJson();
            }

        }
        else
        {
            $completed_challenges = "not logged in";
        }
        return $completed_challenges;
    }
}