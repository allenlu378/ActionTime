@extends('frontend/layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">
           <div class="row">
               <div class="card topLeft">
                   <img  class="gif card-img-top w-auto" src="{{asset('frontend/images/megaphone.png')}}">
                   <div class="card-footer">
                       <h1 class="card-title">Public Challenges</h1>
                   </div>
               </div>
           </div>
           <div class ="row">
               <div class="card bottomLeft">
                   <img src="{{asset('frontend/images/rewards.png')}}" class="rotate-img img-responsive card-img-top w-auto" alt="...">
                   <div class="card-footer">
                       <h1 class="card-title">Rewards</h1>
                   </div>
               </div>
           </div>
       </div>
        <div class="col-md-6">
            <div class ="row h-100 d-flex flex-column justify-content-between">
            <div class="card mid h-100 d-flex flex-column justify-content-between">
                <div class="d-flex flex-row align-items-center h-100">
                <img src="{{asset('frontend/images/person_speaking-512.png')}}" class="mid-img bounce-img img-responsive card-img-top" alt="...">
                </div>
                <div class="card-footer">
                    <h1 class="card-title">My Challenges</h1>
                </div>
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
        <div class="col-md-3">
            <div class="row">
                <div class="card topRight">
                    <img src="{{asset('frontend/images/login.png')}}" class="topRight-img bounce-img img-responsive card-img-top w-auto" alt="...">
                    <div class="card-footer">
                        <h1 class="card-title">Profile</h1>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="card bottomRight">
                    <img src="{{asset('frontend/images/hands.png')}}" class="rotate-img img-responsive card-img-top w-auto" alt="...">
                    <div class="card-footer">
                        <h1 class="card-title">Groups</h1>
                    </div>
                </div>
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
            let middleMarginBottom  = parseFloat(middleCard.css("margin-bottom"));
            let topRatio = firstMarginTop/middleMarginTop;
            let bottomRatio = firstMarginBottom/middleMarginBottom;
            console.log(topRatio);
            console.log(bottomRatio);
            middleCard.css("margin-top", 2*topRatio + '%');
            middleCard.css("margin-bottom", 2*bottomRatio + '%');
            
            
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
                                    step: function(now, fx) {
                                        $(this).css({"transform": "rotate("+now+"deg)"});
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
                    var img = $(".bounce-img");
                    img.each(function () {
                        $(this).hover(function () {
                            let imgClass = $(this)[0].classList[0];
                            console.log(imgClass);
                            $('.' + imgClass).effect("bounce", {times:1},"slow");

                        })
                    })


            });



    </script>
@endsection
