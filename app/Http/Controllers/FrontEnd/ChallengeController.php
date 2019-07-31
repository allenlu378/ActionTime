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

          $challenges = Challenge::with('Task')->where('challenge_type',0)->where('verified',1);
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

         $challenges = $challenges = Challenge::with('Task','startedBy');


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


}
