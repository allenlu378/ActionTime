<?php

namespace App\Console;

use App\Http\Model\ApprovalRequest;
use App\Http\Model\ChallengeProgress;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $expired = ChallengeProgress::whereHas('Challenge',function ($query)
            {
                $query->where('due_time', '<=', Carbon::now());
            });

            $pendingApproval = ApprovalRequest::whereHas('ChallengeProgress',function ($query) {
                $query->whereHas('Challenge',function ($query) {
                    $query->where('approval_request.create_time','<=','challenges.due_time');
                });

            })->where('result', '=',0)->pluck('challenge_progress_id');
            $expired->whereNotIn('id', $pendingApproval)->update(['finish_flag' => - 1]);


        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
