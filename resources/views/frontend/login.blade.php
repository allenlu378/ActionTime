@extends('frontend/layout')
@section('content')
    <!-- <div class="content">
        <div class='left'><img class = 'block-icons' src = "{{asset('frontend/images/public_challenges.png')}}"><span class = 'block-title'>Public Challenges</span>
        </div>
        <div class='middle'><img class = 'block-icons' src = "{{asset('frontend/images/login.png')}}"><span class = 'block-title'>Login/Sign Up</span>
        </div>
        <div class='right'><img class = 'block-icons' src = "{{asset('frontend/images/info.png')}}"><span class = 'block-title'>Learn More</span>
        </div>
    </div>-->
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>About ActionTime</h1>
            </div>
            <div class="row">
                <p class="desc">ActionTime is a planner that can be used to build habits and complete tasks.</p>
            </div>
            <div class="row">
                <div class="col-sm-3    ">
                    <div class="card left">
                        <img class="gif card-img-top" src="{{asset('frontend/images/megaphone.png')}}">
                    <!--<img src="{{asset('frontend/images/megaphone.png')}}" class="card-img-top" alt="...">-->
                        <div class="card-footer">
                            <h1 class="card-title">Public Challenges</h1>
                        </div>
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

                <div class="col-sm-3">
                    <div class="card middle">
                        <img src="{{asset('frontend/images/login.png')}}" class="card-img-top" alt="...">
                        <div class="card-footer">
                            <h1 class="card-title">Login/Sign Up</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card right">
                        <img src="{{asset('frontend/images/info.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-footer">
                            <h1 class="card-title">Learn More</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
