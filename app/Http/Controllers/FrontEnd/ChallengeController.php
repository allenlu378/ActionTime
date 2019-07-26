<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Challenge;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChallengeController extends Controller
{
    public function getPublicChallenges(Request $request) {

          $username = Auth::user();

          $challenges = Challenge::where('challenge_type',0)->where('verified',1);
          dump($challenges->get());
//           if($username)
//          {
//
//           $progress_challenges = DB::table('challenge_progress')->where('user_id', Auth::user()['id'])->
//           select('challenge_progress.challenge_id')->get()->toArray();
//
//           $public_challenges =$challenges->whereNotIn('id',$progress_challenges)->select('*');
//
//          }
//          else
//          {
//              $public_challenges = $challenges;
//          }
//
//          if($request->input('id') > 0)
//          {
//            $public_challenges = $public_challenges->where('challenges.id', '<', $request->input('id'))->orderByDesc('id')->
//            limit(3)->select('*')->get()->toArray();
//          }
//          else
//          {
//
//              $public_challenges = $public_challenges->orderByDesc('challenges.id')->limit(3)->select('*')->get()->toArray();
//          }

          return $challenges;

     }
     public function getPendingChallenges() {
         $username = Auth::user();

         $pending_challenges = "";

         $challenges = DB::table('challenges')->join('task', 'task.id', '=',
             'challenges.task_id')->where('challenge_type',0)->
         where('verified',1);

         if($username)
         {
             $users_groups = DB::table('group_member')->where('user_id', Auth::user()['id'])->pluck('group_id')->toArray();

             $user_current_challenges_id =  DB::table('challenge_progress')->
             join('challenges', 'challenges.id','=', 'challenge_progress.challenge_id')->where('challenges.user_id', Auth::user()['id'])->
             orWhereIn('group_id',$users_groups)->select('challenge_progress.challenge_id')->get()->toArray();

             $pending_challenges = collect($challenges->whereNotIn('id',$user_current_challenges_id)->
             select('*')->get())->toJson();
         }
         else
         {
             $pending_challenges = "not logged in";
         }
         return $pending_challenges;
     }

     public function getCurrentChallenges()
     {
         $username = Auth::user();

         $current_challenges = "";

         $challenges = DB::table('challenge_progress')->join('challenges', 'challenges.id',
             '=', 'challenge_progress.challenge_id');

         if($username)
         {
             $current_challenges = collect($challenges->where('challenge_progress.user_id', Auth::user()['id'])->
                 where('finish_flag',0)->select('*')->get())->toJson();

         }
         else
         {
             $current_challenges = "not logged in";
         }
         return $current_challenges;
     }

     public function getCompletedChallenges()
     {
         $completed_challenges = "";

         $username = Auth::user();

         $challenges = DB::table('challenge_progress')->join('challenges', 'challenges.id',
             '=', 'challenge_progress.challenge_id');

         if($username)
         {
             $all_user_challenges = $current_challenges = $challenges->where('challenge_progress.user_id', Auth::user()['id']);
             $completed_challenges = collect($all_user_challenges->where('finish_flag',-1)->
             orWhere('finish_flag',1)->select('*')->get())->toJson();
         }
         else
         {
             $completed_challenges = "not logged in";
         }
         return $completed_challenges;
     }
}
