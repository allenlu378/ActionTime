@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/home.css')}}" type="text/css" rel="stylesheet" media="all">

    <div class="container-fluid">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4 left-col">

                <!-- Top Left -->
                <div class="row">
                    <a href = "{{route('publicchallenges')}}" class="card topLeft">
                        <img class="card-img-top w-auto" src="{{asset('frontend/images/megaphone.png')}}">
                        <div class="card-footer">
                            <h1 class="card-title">Public Challenges</h1>
                        </div>
                    </a>
                </div>

                <!-- Bottom Left -->
                <div class="row">
                    <div class="card bottomLeft">
                        <img src="{{asset('frontend/images/rewards.png')}}"
                             class="rotate-img img-responsive card-img-top w-auto" alt="...">
                        <div class="card-footer">
                            <h1 class="card-title">Rewards</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Middle Column -->
            <div class="col-md-4 mid-col">
                <!-- Top Middle -->
                <a class="row" href = '/mychallenges'>
                    <div class="card top-mid">
                        <img class="topMid-img card-img-top bounce-img w-auto" src="{{asset('frontend/images/person_speaking-512.png')}}">
                        <div class="card-footer">
                            <h1 class="card-title">My Challenges</h1>
                        </div>
                    </div>
                </a>

                <!-- Bottom Middle -->
                <div class="row">
                    <a class="card bot-mid" href = "/task">
                        <img class="btmMid-img card-img-top bounce-img w-auto" src="{{asset('frontend/images/task.png')}}">
                        <div class="card-footer">
                            <h1 class="card-title">My Tasks</h1>
                        </div>
                    </a>

                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $(".gif").hover(
                        function () {
                            var src = $(this).attr("src");
                            $(this).attr("src", src.replace(/\.png$/i, ".gif"));
                        },
                        function () {
                            var src = $(this).attr("src");
                            $(this).attr("src", src.replace(/\.gif$/i, ".png"));
                        });
                });
            </script>

            <!-- Top Right -->
            <div class="col-md-4 right-col">
                <div class="row">
                    <a class="card topRight" href="/profile">
                        <img src="{{asset('frontend/images/login.png')}}"
                             class="topRight-img bounce-img img-responsive card-img-top w-auto" alt="...">
                        <div class="card-footer">
                            <h1 class="card-title">Profile</h1>
                        </div>
                    </a>
                </div>

                <!-- Bottom Right -->
                <div class="row">
                    <a class="card bottomRight" href = "{{route('group.list')}}">
                        <img src="{{asset('frontend/images/hands.png')}}"
                             class="rotate-img img-responsive card-img-top w-auto" alt="...">
                        <div class="card-footer">
                            <h1 class="card-title">Groups</h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        let topCard = $(".topLeft");
        let bottomCard = $(".bottomLeft");
        let middleCard = $(".mid");
        let firstMarginTop = parseFloat(topCard.css("margin-top"));
        let firstMarginBottom = parseFloat(bottomCard.css("margin-bottom"));
        let middleMarginTop = parseFloat(middleCard.css("margin-top"));
        let middleMarginBottom = parseFloat(middleCard.css("margin-bottom"));
        let topRatio = firstMarginTop / middleMarginTop;
        let bottomRatio = firstMarginBottom / middleMarginBottom;

        middleCard.css("margin-top", 2 * topRatio + '%');
        middleCard.css("margin-bottom", 2 * bottomRatio + '%');


        $(document).ready(function () {
            rotate();

            function rotate() {
                var img = $(".rotate-img");
                img.each(function () {
                    let parentClass = $(this).parent()[0].classList[1];
                    let clone = $(this).clone();
                    $(this).hover(function () {
                        $(this).stop().animate(
                            {rotation: 360},
                            {
                                duration: 500,
                                step: function (now, fx) {
                                    $(this).css({"transform": "rotate(" + now + "deg)"});
                                },
                                complete: function () {
                                    $(this).remove();
                                    clone.prependTo("." + parentClass);
                                    rotate();
                                }
                            }
                        );

                    })
                })


            }


        })
        var img = $(".bounce-img");
        img.each(function () {
            $(this).hover(function () {
                let imgClass = $(this)[0].classList[0];
                console.log(imgClass);
                $('.' + imgClass).effect("bounce", {times: 1}, "slow");

            })
        })


    </script>
@endsection
