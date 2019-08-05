@extends('frontend/loginlayout')
@section('content')

    <link href="{{asset('frontend/css/info.css')}}" type="text/css" rel="stylesheet" media="all">

    <div class="container-fluid">
        <div class="row mt-4">
            <h1>About ActionTime</h1>
        </div>
        <div class="row mt-5">

            <!-- Tasks -->
            <div class="col-md-2 mx-2">
                <div class="card topLeft" id="tasks">
                    <div class="front">
                        <img class="card-img-top w-auto" src="{{asset('frontend/images/task.png')}}">
                        <div class="card-footer">
                            <h1 class="card-title">Tasks</h1>
                        </div>
                    </div>
                    <div class="back">
                        <div class="row mt-2">
                            <h2>Tasks</h2>
                        </div>
                        <hr class="my-0">
                        <p class="info-txt text-left">A task is something you want others to do. In order to make a task a challenge,
                            you must request to make it public or assign it to a group or person.
                            The administrators will decide if the challenge can be made public.
                            Then you must give the task a due date and set a reward, keeping in mind you may only use groups and rewards you created.
                            Then you can send it out to others.</p>
                    </div>
                </div>
            </div>


            <!-- Challenges -->
            <div class="col-md-2 mx-2">
                <div class="card bottomLeft" id="challenges">
                    <div class="front">
                        <img class="rotate-img img-responsive card-img-top w-auto" src="{{asset('frontend/images/challenges.png')}}">
                        <div class="card-footer">
                            <h1 class="card-title">Challenges</h1>
                        </div>
                    </div>
                    <div class="back">
                        <div class="row mt-2">
                            <h2>Challenges</h2>
                        </div>
                        <hr class="my-0">
                        <p class="info-txt text-left">A challenge is a task that has been assigned. You can see challenges sent to you in your my challenges page.
                            You can choose to either accept or decline the challenge.
                            You can also choose to accept public challenges, which will then automatically added to your current challenges.
                            Flipping the challenge card will reveal more information about the challenge. To record progress, fill in the
                            input on the back and send it to the challenge sender for approval. Once a challenge is completed, you will see it
                            in the completed section of the page and the reward will be given to you by the sender.</p>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div class="col-md-2 mx-2">
                <div class="card top-mid" id='general'>
                    <div class="front">
                        <img class="topMid-img card-img-top bounce-img w-auto"
                             src="{{asset('frontend/images/objective.jpg')}}">
                        <div class="card-footer">
                            <h1 class="card-title">Objective</h1>
                        </div>
                    </div>
                    <div class="back">
                        <div class="row mt-2">
                            <h2>Objective</h2>
                        </div>
                        <hr class="my-0">
                        <p class="info-txt text-left">This is a website designed to help kids develop good habits at an early age. By providing a reward,
                            children will have the incentive to put forth their best efforts. This would help with time management as well as with
                            multi-tasking. </p>
                    </div>
                </div>
            </div>

            <!-- Groups -->
            <div class="col-md-2 mx-2">
                <div class="card bot-mid" id="groups">
                    <div class="front">

                        <img class="btmMid-img card-img-top bounce-img w-auto" src="{{asset('frontend/images/hands.png')}}">
                        <div class="card-footer">
                            <h1 class="card-title">Groups</h1>
                        </div>
                    </div>
                    <div class="back">
                        <div class="row mt-2">
                            <h2>Groups</h2>
                        </div>
                        <hr class="my-0">
                        <p class="info-txt text-left">You can create a group and add members to it, with a miniumm of one other member. You are
                            automatically added. You are able to change the names and add/delete members from groups you have created. You can also
                            view groups others have added you to and you have the option to leave.</p>
                    </div>

                </div>
            </div>

            <!-- Rewards -->
            <div class="col-md-2 mx-2">
                <div class="card topRight" id='rewards'>
                    <div class="front">
                        <img src="{{asset('frontend/images/rewards.png')}}"
                             class="topRight-img bounce-img img-responsive card-img-top w-auto" alt="...">
                        <div class="card-footer">
                            <h1 class="card-title">Rewards</h1>
                        </div>
                    </div>
                    <div class="back">
                        <div class="row mt-2">
                            <h2>Rewards</h2>
                        </div>
                        <hr class="my-0">
                        <p class="info-txt text-left">You can create your own rewards, setting options such as the total number you own and how
                        are remaining. You can then add them to tasks you are assigning. Rewards you have received from other challenges are displayed
                        in your profile page.</p>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $(".card").each(function () {
                        $(this).on('click', function (e) {
                            var card_id = "#" + $(this).attr('id');
                            $(card_id).toggleClass('info-flip');

                        })

                    })
                });
            </script>


        </div>
    </div>
@endsection