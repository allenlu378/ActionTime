<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\ApprovalRequest;

class ApprovalRequestController extends Controller
{
    public function submitProgress(Request $request)
    {
        $user = Auth::user()['id'];
        $id = $request['id'];
        $current_progress =(int)$request['current_progress'];
        $new_value = (int)$request['new_value'];
        $add_value = $new_value - $current_progress;
        $result = 0;
        $create_time = $time = Carbon::now()->toDateTimeString();

        ApprovalRequest::create(['requested_by' => $user, 'challenge_progress_id' => $id, 'add_value' => $add_value,
            'result' => $result, 'create_time' => $create_time]);
        return route('mychallenges');
    }

    public function getRequests()
    {
        $user = Auth::user()['id'];
        $all_requests = ApprovalRequest::with('ChallengeProgress');
        $requests = $all_requests->whereHas('ChallengeProgress', function ($query) use ($user){
            $query->whereHas('Challenge', function ($query) use ($user) {
                $query->where('start_by', '=', $user);
            });
        })->where('result', '=',0)->get()->toJson();
        return $requests;

    }
}
