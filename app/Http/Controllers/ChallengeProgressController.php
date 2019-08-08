<?php

namespace App\Http\Controllers;

use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\ChallengeProgress;
use App\Http\Model\Challenge;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ChallengeProgressController extends Controller
{
    public function getCurrentChallenges(Request $request)
    {
        $username = Auth::user();

        $current_challenges = "";

        $challenges = ChallengeProgress::with('Challenge');
        if ($username) {
            $current_challenges = $challenges->where('challenge_progress.user_id', Auth::user()['id'])->
            where('finish_flag', '=', 0);

            if ($request->input('id') > 0) {
                $current_challenges = $current_challenges->where('challenge_progress.id', '<', $request->input('id'))->orderByDesc('id')->
                limit(3)->select('*')->get()->toJson();
            } else {

                $current_challenges = $current_challenges->orderByDesc('challenge_progress.id')->limit(3)->select('*')->get()->toJson();
            }
        } else {
            $current_challenges = "not logged in";
        }
        return $current_challenges;
    }

    public function getCompletedChallenges(Request $request)
    {
        $completed_challenges = "";

        $username = Auth::user();

        $challenges = ChallengeProgress::with('Challenge');

        if ($username) {
            $all_user_challenges = $challenges->where('user_id', Auth::user()['id']);
            $completed_challenges = $all_user_challenges->where(function ($query) {
                $query->where('finish_flag', '=', -1)->orWhere('finish_flag', '=', 1);
            });

            if ($request->input('id') > 0) {
                $completed_challenges = $completed_challenges->where('id', '<', $request->input('id'))->orderByDesc('challenge_progress.id')->
                limit(3)->select('*')->get()->toJson();
            } else {

                $completed_challenges = $completed_challenges->orderByDesc('challenge_progress.id')->limit(3)->select('*')->get()->toJson();
            }

        } else {
            $completed_challenges = "not logged in";
        }
        return $completed_challenges;
    }


    public function acceptChallenges(Request $request)
    {
        $id = $request->input('id');
        $user_id = Auth::user()['id'];
        $current_value = 0;
        $percent = 0;
        $time = Carbon::now()->toDateTimeString();
        $finished = 0;
        ChallengeProgress::create(['challenge_id' => $id, 'user_id' => $user_id, 'current_value' => $current_value,
            'percent' => $percent, 'start_time' => $time, 'finish_flag' => $finished]);
        $task_id = Challenge::where('id', $id)->pluck('task_id')[0];
        return route('mychallenges');


    }

    public function getAcceptedChallenges()
    {
        $user = Auth::user()['id'];
        $accepted = ChallengeProgress::with('Challenge', 'User')->whereHas('Challenge', function ($query) use ($user) {
            $query->where('start_by', $user);
        })->orderByDesc('id')->get()->toJson();
        return $accepted;
    }


    public function rankChallenges($id)
    {
        $challenges_first = ChallengeProgress::with('Challenge')->whereHas('Challenge', function ($query) use ($id) {
                $query->where('task_id', '=', $id);
            });
        $completed = $challenges_first->where('finish_flag', 1);
        $previousRank = 0;
        if($completed->count() > 0) {
            $completed_ids = $completed->pluck('id')->toArray();
            $duration = [];

            foreach ($completed_ids as $completed_id) {
                $started = Carbon::parse(ChallengeProgress::where('id', $completed_id)->pluck('start_time')[0]);
                $finished = Carbon::parse(ChallengeProgress::where('id', $completed_id)->pluck('finish_time')[0]);

                array_push($duration, $started->diffInHours($finished));

            }
            for ($i = 0; $i < sizeof($completed_ids); $i++) {
                $low = $i;
                for ($j = $i + 1; $j < sizeof($completed_ids); $j++) {
                    if ($duration[$j] < $duration[$low]) {
                        $low = $j;
                    }
                }

                // swap the minimum value to $ith node
                if ($duration[$i] > $duration[$low]) {
                    $tmpduration = $duration[$i];
                    $tmpid = $completed_ids[$i];
                    $duration[$i] = $duration[$low];
                    $completed_ids[$i] = $completed_ids[$low];
                    $duration[$low] = $tmpduration;
                    $completed_ids[$low] = $tmpid;
                }

            }
            for ($index = 0; $index < sizeof($completed_ids); $index++) {
                $challenge = ChallengeProgress::where('id', $completed_ids[$index]);
                if ($index = 0) {
                    $rank = 1;

                } elseif ($duration[$index] == $duration[$index - 1]) {
                    $rank = $previousRank;
                } else {
                    $rank = $previousRank + 1;
                }
                $challenge->update(['ranking' => $rank]);

                $previousRank = $rank;
            }
        }
       $challenges_second = ChallengeProgress::with('Challenge')->whereHas('Challenge', function ($query) use ($id) {
           $query->where('task_id', '=', $id);
       });
        $uncompleted = $challenges_second->where(function ($query){
            $query->where('finish_flag', -1)->orWhere('finish_flag',0);
        });
        if($uncompleted->count() > 0)
        {
            $uncompleted_challenges = $uncompleted->get()->toArray();
            for($index = 0; $index<sizeof($uncompleted_challenges); $index++)
            {
                if($index != 0 && (($uncompleted_challenges[$index]['percent']) == ($uncompleted_challenges[$index - 1]['percent'])))
                {
                    $rank = $previousRank;
                }
                else
                {
                    $rank = $previousRank + 1;
                }


                $previousRank =$rank;
                $challenge = $uncompleted->where('id',$uncompleted_challenges[$index]['id']);
                $challenge->update(['ranking' => $rank]);
            }
        }


    }
}
