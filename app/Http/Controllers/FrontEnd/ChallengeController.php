<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Challenge;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Model\Group;
use App\User;
use App\Http\Model\Award;

class ChallengeController extends Controller
{
    public function assignChallenge(Request $request)
    {
        $task_id = $request['id'];
        $due_time = Carbon::createFromFormat('m/d/Y g:i:s A', $request['due_time'])->toDateTimeString();
        $type = (int)$request['radio1'];
        $started_by = Auth::user()['id'];
        $group_id = null;
        $user_id = null;
        if($request->has('group'))
        {
            $group_id = Group::where('name', $request['group'])->pluck('id')[0];
        }
        else if ($request->has('user'))
        {
            $user_id = User::where('email',$request['user'])->pluck('id')[0];
        }
        $reward_id = Award::where('award_name', $request['reward'])->pluck('id')[0];
        $verified = null;

        if($type == 0)
        {
            $verified = 0;
        }

        Challenge::create(['task_id' => $task_id, 'award_id' => $reward_id, 'start_by' => $started_by, 'due_time' => $due_time, 'challenge_type' => $type, 'group_id' => $group_id, 'user_id' => $user_id, 'verified' => $verified]);

        return redirect('/createdchallenges');
    }
    public function getPublicChallenges(Request $request) {

          $username = Auth::user();

          $challenges = Challenge::with('Task','Award')->where('challenge_type',0)->where('verified','=',1);
          if($username)
          {

           $progress_challenges = DB::table('challenge_progress')->where('user_id', Auth::user()['id'])->pluck('challenge_id')->toArray();

           $public_challenges =$challenges->whereNotIn('challenges.id',$progress_challenges);
          }
          else
          {
              $public_challenges = $challenges;
          }

          if($request->input('id') > 0)
          {
            $public_challenges = $public_challenges->where('id', '<', $request->input('id'))->orderByDesc('id')->
            limit(3)->select('*')->get()->toJson();
          }
          else
          {

              $public_challenges = $public_challenges->orderByDesc('id')->limit(3)->select('*')->get()->toJson();
          }

          return $public_challenges;

     }
     public function getPendingChallenges(Request $request) {
         $username = Auth::user();

         $pending_challenges = "";

         $challenges = $challenges = Challenge::with('Task','startedBy','Award');


         if($username)
         {

             $progress_challenges =  DB::table('challenge_progress')->where('user_id', Auth::user()['id'])->
             pluck('challenge_progress.challenge_id')->toArray();

             $pending_challenges = $challenges->whereNotIn('id',$progress_challenges)->
                where(function ($query) {
                    $query->where('user_id', Auth::user()['id'])->orWhereIn('group_id',
                    DB::table('group_member')->where('user_id', Auth::user()['id'])->
                    pluck('group_id')->toArray());
                });

             if($request->input('id') > 0)
             {
                 $pending_challenges = $pending_challenges->where('challenges.id', '<', $request->input('id'))->orderByDesc('id')->
                 limit(3)->select('*')->get()->toJson();
             }
             else
             {

                 $pending_challenges = $pending_challenges->orderByDesc('challenges.id')->limit(3)->select('*')->get()->toJson();
             }
         }
         else
         {
             $pending_challenges = "not logged in";
         }
         return $pending_challenges;
     }
     public function getUnverifiedPublicChallenges()
     {
         $admin_id = DB::table('user_group')->where('name','admin')->pluck('id');
         $user_admin = DB::table('group_member')->where('group_id',$admin_id)->
         where('user_id', Auth::user()['id'])->get()->count();
         $challenges = Challenge::with('Task','Award')->where('challenge_type',0)->
         where('verified','=',0)->select('*')->get()->toJson();
         if($user_admin > 0)
         {
             return $challenges;
         }
         return 'not admin';
     }

    public function VerifyPublicChallenge(Request $request)
    {
        $id = $request->input('id');
        $decision = $request->input('admin_decision');
        Challenge::where('id',$id)->update(['verified' => $decision]);
        return route('publicchallenges');

    }

    public function getUnacceptedChallenges()
    {
        $user = Auth::user()['id'];
        $unaccepted = Challenge::with('Task','startedBy','Award')->where('start_by', $user)->
        whereNotIn('id',DB::table('challenge_progress')->pluck('challenge_progress.challenge_id')->toArray())->get()->toJson();
        return $unaccepted;
    }




}
