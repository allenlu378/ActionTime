<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\ApprovalRequest;
use App\Http\Model\ChallengeProgress;

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
        $all_requests = ApprovalRequest::with('ChallengeProgress','requestedBy');
        $requests = $all_requests->whereHas('ChallengeProgress', function ($query) use ($user){
            $query->whereHas('Challenge', function ($query) use ($user) {
                $query->where('start_by', '=', $user);
            });
        })->where('result', '=',0)->orderByDesc('id') ->get()->toJson();
        return $requests;

    }

    public function approveChallengeProgress(Request $request)
    {
        $id = $request['id'];
        $sender_decision = (int)$request['senderDecision'];

        if ($sender_decision == 1)
        {
            $approvalRequest = ApprovalRequest::where('id',$id);
            $approvalRequest->update(['feedback' => 'Approve', 'result' => $sender_decision,'approved_by' => Auth::user()['id']]);
            $challengeProgress = ChallengeProgress::where('id', $approvalRequest->pluck('challenge_progress_id')[0]);
            $addValue = (int)$approvalRequest->pluck('add_value')[0];
            $currentValue = (int)$challengeProgress->pluck('current_value')[0];
            $newValue = $currentValue + $addValue;
            $totalValue = (int)($challengeProgress->first()->challenge->task->total_value);
            $percent = ($newValue/$totalValue)*100;
            $finish_time = null;
            $finished = $challengeProgress->pluck('finish_flag')[0];
            $task_id = $challengeProgress->first()->challenge->task->id;
            if(((int)$percent) == 100)
            {
                $finished =1;
                $finish_time = $approvalRequest->pluck('create_time')[0];


            }
            $challengeProgress->update(['current_value' => $newValue, 'percent' =>$percent, 'finish_flag' => $finished, 'finish_time' => $finish_time]);
            app('App\Http\Controllers\ChallengeProgressController')->rankChallenges($task_id);


        }
        else
        {
            ApprovalRequest::where('id',$id)->update(['feedback' => 'Refuse', 'result' => $sender_decision]);
        }
        return route('createdchallenges');

    }


}
