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
                        <hr class="mt-0">
                        <p class="info-txt">A bunch of text about tasks. A bunch of text about tasks. A bunch of text about tasks.</p>
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
                        <hr class="mt-0">
                        <p class="info-txt">A bunch of text. A bunch of text. A bunch of text.</p>
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
                            <h2>General</h2>
                        </div>
                        <hr class="mt-0">
                        <p class="info-txt">A bunch of text. A bunch of text. A bunch of text.</p>
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
                        <hr class="mt-0">
                        <p class="info-txt">A bunch of text. A bunch of text. A bunch of text.</p>
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
                        <hr class="mt-0">
                        <p class="info-txt">A bunch of text. A bunch of text. A bunch of text.</p>
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