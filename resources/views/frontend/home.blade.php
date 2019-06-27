@extends('frontend/layout')
@section('content')
    <!-- banner -->

    <div class="banner">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <div class="banner-img1">
                            <div class="banner-w3text">
                                <h2>Temporibus autem Quisque <br> nunc ullamcorper eget volutpat </h2>
                                <a href="#myModal" class="agilebtn" data-toggle="modal" data-target="#myModal"><span>Read More</span></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner-img2">
                            <div class="banner-w3text">
                                <h3>Volutpat quis enim Donec <br>massa ipsum imperdiet euornare</h3>
                                <a href="#myModal" class="agilebtn" data-toggle="modal" data-target="#myModal"><span>Read More</span></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
        <script defer src="{{asset("frontend/js/jquery.flexslider.js")}}"></script>
        <script type="text/javascript">
            $(window).load(function(){
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function(slider){
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
        <!-- //FlexSlider -->
    </div>


    <!-- //banner -->
    <!-- modal-about -->
    <div class="modal bnr-modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body modal-spa">
                    <img src="images/img2.jpg" class="img-responsive" alt=""/>
                    <h4>Cras rutrum iaculis enim</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras rutrum iaculis enim, non convallis felis mattis at. Donec fringilla lacus eu pretium rutrum. Cras aliquet congue ullamcorper. Etiam mattis eros eu ullamcorper volutpat. Proin ut dui a urna efficitur varius. uisque molestie cursus mi et congue consectetur adipiscing elit cras rutrum iaculis enim, Lorem ipsum dolor sit amet, non convallis felis mattis at. Maecenas sodales tortor ac ligula ultrices dictum et quis urna. Etiam pulvinar metus neque, eget porttitor massa vulputate in. Fusce lacus purus, pulvinar ut lacinia id, sagittis eu mi. Vestibulum eleifend massa sem, eget dapibus turpis efficitur at. </p>
                </div>
            </div>
        </div>
    </div>
    <!-- //modal-about -->
    <!-- about -->
    <div class="about w3-agileits">
        <div class="container">
            <div class="col-md-6 about-left">
                <h3 class="agileits-title">Welcome To Kids Care</h3>
            </div>
            <div class="col-md-6 about-right agileits-w3layoutsleft">
                <h4>Sed tincidunt lorem ipsum</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt lorem sed velit fermentum lobortis, eget placerat mauris sed lectus tellus</p>
                <p>Fusce eu semper lacus, sodales id elit a, feugiat porttitor nulla. Sed porta magna vitae nisl vulputate lacinia.</p>
                <ul>
                    <li><span class="glyphicon glyphicon-share-alt"></span> Duis aute irure dolor in reprehenderit voluptate </li>
                    <li><span class="glyphicon glyphicon-share-alt"></span> Excepteur sint occaecat cupidatat non proident</li>
                    <li><span class="glyphicon glyphicon-share-alt"></span> Sunt in culpa qui officia deserunt mollit </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //about -->

    <!-- slid -->
    <div class="w3layouts-slid">
        <div class="container">
            <h4>What you need to do?</h4>
            <p>Choose one of them</p>
            <a href="#myModal" class="agilebtn" data-toggle="modal" data-target="#myModal"><span>Read More</span></a>
        </div>
    </div>
    <!-- //slid -->

    <!-- gallery -->
    <div class="gallery w3-agileits">
        <div class="container">
            <h3 class="agileits-title1 w3-agileits">Your Acknowledged Assignments</h3>
            <div class="agileinfo-gallery-row">
                @forelse($acked_assignments as $a)
                    <div class="col-md-4 col-sm-4 col-xs-6 w3gallery-grids">
                        <a href="{{route("assignment.schedule",['id'=>$a['id']])}}" data-toggle="modal" data-target="#myModal" class="imghvr-hinge-right wthree">
                            <img src="{{asset('upload')}}/{{$a->task['img']}}" class="img-response" alt="" title="Kids Care Image"/>
                            <div class="agile-figcaption">
                                <h4>{{$a->task['name']}}</h4>
                                <h5>Process:{{$a['percent']*100}}%</h5>
                                <p>{{$a->task['description']}}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-md-4 col-sm-4 col-xs-6 w3gallery-grids">
                        <a href="" class="imghvr-hinge-right wthree">
                            <img src="{{asset("frontend/images/empty.jpg")}}" class="img-response" alt="" title="Kids Care Image"/>
                            <div class="agile-figcaption">
                                <h4>None</h4>
                                <p>You can pick one</p>
                            </div>
                        </a>
                    </div>
                @endforelse
                <div class="clearfix"> </div>
{{--                <script defer src="{{asset("frontend/js/simple-lightbox.min.js")}}"></script>--}}
{{--                <script>--}}
{{--                    $(function(){--}}
{{--                        var gallery = $('.agileinfo-gallery-row a').simpleLightbox({navText:		['&lsaquo;','&rsaquo;']});--}}
{{--                    });--}}
{{--                </script>--}}
            </div>
        </div>

        <div class="container">
            <h3 class="agileits-title1 w3-agileits">Your Acknowledging Assignments</h3>
            <div class="agileinfo-gallery-row">
                @forelse($acking_assignments as $a)
                    <div class="col-md-4 col-sm-4 col-xs-6 w3gallery-grids">
                        <a href="#" class="imghvr-hinge-right wthree">
                            <img src="{{asset('upload')}}/{{$a->task['img']}}" class="img-response" alt="" title="Kids Care Image"/>
                            <div class="agile-figcaption">
                                <h4>{{$a->task['name']}}</h4>
                                <h5>Process:{{$a['percent']*100}}%</h5>
                                <p>{{$a->task['description']}}</p>
                            </div>
                        </a>
                    </div>
                @empty
                        <div class="col-md-4 col-sm-4 col-xs-6 w3gallery-grids">
                            <a href="#" class="imghvr-hinge-right wthree">
                                <img src="{{asset("frontend/images/empty.jpg")}}" class="img-response" alt="" title="Kids Care Image"/>
                                <div class="agile-figcaption">
                                    <h4>None</h4>
                                    <p>You can pick one</p>
                                </div>
                            </a>
                        </div>
                @endforelse

                <div class="clearfix"> </div>
                <script defer src="{{asset("frontend/js/simple-lightbox.min.js")}}"></script>
                <script>
                    $(function(){
                        var gallery = $('.agileinfo-gallery-row a').simpleLightbox({navText:		['&lsaquo;','&rsaquo;']});
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- //gallery -->
    <!-- slid -->
    <div class="w3layouts-slid">
        <div class="container">
            <h4>What you can get?</h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a href="#myModal" class="agilebtn" data-toggle="modal" data-target="#myModal"><span>Read More</span></a>
        </div>
    </div>
    <!-- //slid -->
    <!-- testimonial -->
    <div class="testimonial">
        <div class="container">
            <h3 class="agileits-title1">Your Gifts</h3>
            <div class="flipster">
                <ul>
                    @foreach($awards as $a)
                        <li>
                            <div class="agile-testi">
                                <div class="agile-testi-top">
                                </div>
                                <div class="agile-testi-bottom">
                                    <img src="{{asset('upload')}}/{{$a['img']}}" alt="" width="203px" height="100px"/>
                                    <h4>{{$a['name']}}</h4>
                                    <h6>{{$a['owner']}}</h6>
                                    <p>{{$a['description']}}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <script src="{{asset("frontend/js/jquery.flipster.js")}}"></script>
            <script>
                $(function(){ $(".flipster").flipster({ style: 'carousel', start: 0 }); });
            </script>
        </div>
    </div>
    <!-- //testimonial -->
    <!-- slid -->
    <div class="w3layouts-slid">
        <div class="container">
            <h4>Let the Learning Begin</h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a href="#myModal" class="agilebtn" data-toggle="modal" data-target="#myModal"><span>Read More</span></a>
        </div>
    </div>
    <!-- //slid -->
    <!-- services -->
    <div class="services agileits-w3layouts">
        <div class="container">
            <h3 class="agileits-title1">Our Advantage</h3>
            <div class="services-w3lsrow">
                <div class="col-md-4 col-sm-4 services-grid">
                    <span class="fa fa-check-square-o wthree" aria-hidden="true"></span>
                    <h5>Quality Programs</h5>
                    <p>Introduce our program: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras rutrum iaculis enim, non convallis felis mattis at</p>
                </div>
                <div class="col-md-4 col-sm-4 services-grid">
                    <span class="fa fa-heart wthree" aria-hidden="true"></span>
                    <h5>Special Child Care</h5>
                    <p>Introduce the benefit of good habit: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras rutrum iaculis enim, non convallis felis mattis at</p>
                </div>
                <div class="col-md-4 col-sm-4 services-grid">
                    <span class="fa fa-puzzle-piece wthree" aria-hidden="true"></span>
                    <h5>Special Education</h5>
                    <p>Describe our education</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //services -->
@endsection
