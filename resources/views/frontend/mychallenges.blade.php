@extends('frontend/layout')
@section('content')


<link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row my-challenges">
                 <h1>My Challenges</h1>
            </div>
            <div class="row pending-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Pending Challenges
                </h2>
                <div class="row pending-container w-100 mx-2 my-2">
                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                                <div class="row button-container over mr-4">
                                    <div class="col-md-12">
                                        <input  class="btn btn-primary float-right view-challenge-button" type="button" data-toggle="collapse"
                                        aria-expanded="false"
                                        aria-controls="my-challenge-1" value="View Challenge" data-target="#my-challenge-1"/>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="challenge-info collapse"  id="my-challenge-1">
                                        <div class="row challenge-desc">
                                            <p class="mx-5 card-text challenge-desc-content">
                                                This is a challenge. Challenges encourage students to complete tasks on time
                                                by motivating them with points one a task is completed. Parents can then use
                                                these points to give their children rewards. The goal of this is to make learning fun.
                                                </p>
                                        </div>
                                        <div class="row challenge-data mx-5">
                                             <div class="col-md-6">
                                                Sender: user
                                            </div>
                                            <div class="col-md-6">
                                                Reward: 10 points
                                            </div>
                                         </div>
                                    <div class="row button-container over mr-4">
                                        <div class="col-md-12">
                                            <input  class="btn btn-primary  float-right" type="button"
                                            value="Accept Challenge" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-2" value="View Challenge" data-target="#my-challenge-2"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="challenge-info collapse"  id="my-challenge-2">
                                    <div class="row challenge-desc">
                                        <p class="mx-5 card-text challenge-desc-content">
                                            This is a challenge. Challenges encourage students to complete tasks on time
                                            by motivating them with points one a task is completed. Parents can then use
                                            these points to give their children rewards. The goal of this is to make learning fun.
                                        </p>
                                    </div>
                                    <div class="row challenge-data mx-5">
                                        <div class="col-md-6">
                                            Sender: user
                                        </div>

                                        <div class="col-md-6">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row button-container over mr-4">
                                        <div class="col-md-12">
                                            <input  class="btn btn-primary  float-right" type="button"
                                                    value="Accept Challenge" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-3" value="View Challenge" data-target="#my-challenge-3"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="challenge-info collapse"  id="my-challenge-3">
                                    <div class="row challenge-desc">
                                        <p class="mx-5 card-text challenge-desc-content">
                                            This is a challenge. Challenges encourage students to complete tasks on time
                                            by motivating them with points one a task is completed. Parents can then use
                                            these points to give their children rewards. The goal of this is to make learning fun.
                                        </p>
                                    </div>
                                    <div class="row challenge-data mx-5">
                                        <div class="col-md-6">
                                            Sender: user
                                        </div>

                                        <div class="col-md-6">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row button-container over mr-4">
                                        <div class="col-md-12">
                                            <input  class="btn btn-primary float-right" type="button"
                                                    value="Accept Challenge" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row accepted-challenges my-challenge-headings">
            <h2 class="mx-5">
                Accepted Challenges
            </h2>
            <div class="row accepted-container w-100 mx-2 my-2">
                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                        aria-expanded="false"
                                        aria-controls="my-challenge-4" value="View Challenge" data-target="#my-challenge-4"/>
                                </div>
                            </div>
                        </div>
                        <div class="challenge-info collapse"  id="my-challenge-4">
                            <div class="row challenge-desc">
                                <p class="mx-5 card-text challenge-desc-content">
                                    This is a challenge. Challenges encourage students to complete tasks on time
                                    by motivating them with points one a task is completed. Parents can then use
                                    these points to give their children rewards. The goal of this is to make learning fun.
                                </p>
                            </div>
                            <div class="row challenge-data mx-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            Sender: user
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Start Time: 7/12/19 3:43 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Due Time: 7/15/19 11:59 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            <label for="current-progress">Current Progress: </label>
                                            <input id="current-progress" type="number" value="0" min="0" max="999" step="0.5"/>/25
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Percent Complete:
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Ranking: 10th
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Finished:
                                            <div class="rounded-circle challenge-finished-indicator-accepted">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary float-right" type="button"
                                            value="Submit Progress" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-5" value="View Challenge" data-target="#my-challenge-5"/>
                                </div>
                            </div>
                        </div>
                        <div class="challenge-info collapse"  id="my-challenge-5">
                            <div class="row challenge-desc">
                                <p class="mx-5 card-text challenge-desc-content">
                                    This is a challenge. Challenges encourage students to complete tasks on time
                                    by motivating them with points one a task is completed. Parents can then use
                                    these points to give their children rewards. The goal of this is to make learning fun.
                                </p>
                            </div>
                            <div class="row challenge-data mx-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            Sender: user
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Start Time: 7/12/19 3:43 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Due Time: 7/15/19 11:59 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            <label for="current-progress">Current Progress: </label>
                                            <input id="current-progress" type="number" value="0" min="0" max="999" step="0.5"/>/25
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Percent Complete:
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Ranking: 10th
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Finished:
                                            <div class="rounded-circle challenge-finished-indicator-accepted">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary float-right" type="button"
                                            value="Submit Progress" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-6" value="View Challenge" data-target="#my-challenge-6"/>
                                </div>
                            </div>
                        </div>
                        <div class="challenge-info collapse"  id="my-challenge-6">
                            <div class="row challenge-desc">
                                <p class="mx-5 card-text challenge-desc-content">
                                    This is a challenge. Challenges encourage students to complete tasks on time
                                    by motivating them with points one a task is completed. Parents can then use
                                    these points to give their children rewards. The goal of this is to make learning fun.
                                </p>
                            </div>
                            <div class="row challenge-data mx-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            Sender: user
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Start Time: 7/12/19 3:43 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Due Time: 7/15/19 11:59 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            <label for="current-progress">Current Progress: </label>
                                            <input id="current-progress" type="number" value="0" min="0" max="999" step="0.5"/>/25
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Percent Complete:
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Ranking: 10th
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Finished:
                                            <div class="rounded-circle challenge-finished-indicator-accepted">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary float-right" type="button"
                                            value="Submit Progress" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row completed-challenges my-challenge-headings">
            <h2 class="mx-5">
                Completed Challenges
            </h2>
            <div class="row completed-container w-100 mx-2 my-2">
                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-7" value="View Challenge" data-target="#my-challenge-7"/>
                                </div>
                            </div>
                        </div>
                        <div class="challenge-info collapse"  id="my-challenge-7">
                            <div class="row challenge-desc">
                                <p class="mx-5 card-text challenge-desc-content">
                                    This is a challenge. Challenges encourage students to complete tasks on time
                                    by motivating them with points one a task is completed. Parents can then use
                                    these points to give their children rewards. The goal of this is to make learning fun.
                                </p>
                            </div>
                            <div class="row challenge-data mx-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            Sender: user
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Start Time: 7/12/19 3:43 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Due Time: 7/15/19 11:59 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            <label>Current Progress: </label>
                                            25/25
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Percent Complete:
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Ranking: 10th
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Finished: 7/15/19 11:00 PM
                                            <div class="rounded-circle challenge-finished-indicator-complete">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-8" value="View Challenge" data-target="#my-challenge-8"/>
                                </div>
                            </div>
                        </div>
                        <div class="challenge-info collapse"  id="my-challenge-8">
                            <div class="row challenge-desc">
                                <p class="mx-5 card-text challenge-desc-content">
                                    This is a challenge. Challenges encourage students to complete tasks on time
                                    by motivating them with points one a task is completed. Parents can then use
                                    these points to give their children rewards. The goal of this is to make learning fun.
                                </p>
                            </div>
                            <div class="row challenge-data mx-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            Sender: user
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Start Time: 7/12/19 3:43 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Due Time: 7/15/19 11:59 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            <label>Current Progress: </label>
                                            25/25
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Percent Complete:
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Ranking: 10th
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Finished: 7/15/19 11:00 PM
                                            <div class="rounded-circle challenge-finished-indicator-complete">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="card w-100">
                        <div class="card-header">
                            <h1 class="card-title">This is a challenge</h1>
                            <div class="row button-container over mr-4">
                                <div class="col-md-12">
                                    <input  class="btn btn-primary view-challenge-button float-right" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-9" value="View Challenge" data-target="#my-challenge-9"/>
                                </div>
                            </div>
                        </div>
                        <div class="challenge-info collapse"  id="my-challenge-9">
                            <div class="row challenge-desc">
                                <p class="mx-5 card-text challenge-desc-content">
                                    This is a challenge. Challenges encourage students to complete tasks on time
                                    by motivating them with points one a task is completed. Parents can then use
                                    these points to give their children rewards. The goal of this is to make learning fun.
                                </p>
                            </div>
                            <div class="row challenge-data mx-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            Sender: user
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Start Time: 7/12/19 3:43 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Due Time: 7/15/19 11:59 PM
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Reward: 10 points
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 accepted-challenges-col">
                                            <label>Current Progress: </label>
                                            25/25
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Percent Complete:
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Ranking: 10th
                                        </div>
                                        <div class="col-md-3 accepted-challenges-col">
                                            Finished: 7/15/19 11:00 PM
                                            <div class="rounded-circle challenge-finished-indicator-complete">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var viewChallengeButtons = $(".view-challenge-button");
        $(viewChallengeButtons).each(function () {

            $(this).on('click', function () {
                if($(this).val() == "View Challenge")
                {
                    $(this).val("Hide Challenge")
                }
                else
                {
                    $(this).val("View Challenge")
                }
            })
        })
    });
</script>
@endsection

