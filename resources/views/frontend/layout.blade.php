<!DOCTYPE html>
<html lang="en">
<head>
    <title>Goal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Custom Theme files-->
    <link href="{{asset('bootstrap4/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" media="all">

    <link href="{{asset('frontend/css/style.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href='{{asset('frontend/css/simplelightbox.css')}}' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("frontend/css/flexslider.css")}}" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{asset("frontend/css/jquery.flipster.css")}}">
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="{{asset('frontend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="{{asset('frontend/js/jquery-2.2.3.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="{{asset('bootstrap4/js/bootstrap.js')}}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <!-- //js -->
    <!-- web-fonts -->
    <link href="//fonts.googleapis.com/css?family=Parisienne" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <!-- //web-fonts -->
</head>
<body>
<!-- header -->
<div class="headerw3l" id="header">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">
            @if(!(Auth::user()['img'] == null and Auth::user()['user_name'] != null))
            <div class="navbar-header navbar-left">
                <h1><a href="/">ActionTime<span><i>Learn.</i> <i class="logo-w3l2">Share.</i> <i
                                    class="logo-w3l3"> Laugh.</i> <i class="logo-w3l4"> Grow.</i></span></a></h1>
            </div>
            @endif
            <!-- navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">

                    </li>

                </ul>

                <div class="clearfix"></div>
                @auth
                @if(Auth::user()['img'] == null)
                    @php $img = '../../../frontend/images/head.png'; @endphp
                @else
                    @php $img = '../../../upload/'.Auth::user()['img']; @endphp
                @endif
            </div><!-- //navigation -->
            <div class="profile">
                <div class="row nav-row">

                    <div class="col-md-9" id = "nav-col-9">
                        <a id = "username" href="/profile" class="link link--yaku navbar-user mt-3" onmouseover="deeperColorUser()" onmouseout="normalColorUser()">{{Auth::user()['user_name']}}</a>

                    </div>
                    <div class="col-md-2 px-0">
                        <div class="nav-prof-container shadow-sm">
                            <input type="image" id="nav-prof" class="nav-prof-pic dropdown-toggle"
                                   src="{{$img}}" onclick = "signOut()">
                        </div>
                    </div>
                    <div class="col-md-1 px-0 icon-col">
                        <i class="fa nav-fa" onclick = "signOut()">&#xf0d7;</i>
                    </div>

                </div>
                <div id="myDropdown" class="dropdown-content mt-3" onmouseover="deeperColor()" onmouseout="normalColor()">
                    <a href="{{route('signout')}}">Sign Out</a>

                </div>


            </div>
            <script>
                function signOut(){
                    document.getElementById("myDropdown").classList.toggle("show");
                }
                window.onclick = function(event) {
                    if (!event.target.matches('.fa') && !event.target.matches('.nav-prof-pic')) {
                        var dropdowns = document.getElementsByClassName("dropdown-content");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }
            </script>
            @endauth

        </div>
    </nav>
</div>
<script>
    function randomColor() {
        var letters = '89ABC';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 5)];
        }
        return color;
    }

    color = randomColor();
</script>
<!-- //header -->
<div class="page-content">
    @yield('content')
</div>
<!-- footer -->
<div class="copy-right fixed-bottom" id="footer">
    <div class="container">
        <p>© 2019 ActionTime. All rights reserved | Design by <a href="#"> Monmouth University</a></p>
    </div>
</div>
<script>
    let copyright = $(".copy-right");
    let copyrightHeight = parseFloat(copyright.css("height"));
    let container = $(".page-content");
    container.css("padding-bottom", copyrightHeight + 'px');
</script>
<script>

    var header = document.getElementById("header");
    header.style.backgroundColor = color;
    var navbar = document.getElementById('navbar');
    navbar.style.backgroundColor = color;
    var footer = document.getElementById("footer");
    footer.style.background = color;
    signout = document.getElementById('myDropdown');
    signout.style.background = color;
    username = document.getElementById('username');
    function shadeColor(percent) {

        var R = parseInt(color.substring(1,3),16);
        var G = parseInt(color.substring(3,5),16);
        var B = parseInt(color.substring(5,7),16);

        R = parseInt(R * (100 - percent) / 100);
        G = parseInt(G * (100 - percent) / 100);
        B = parseInt(B * (100 - percent) / 100);

        R = (R<255)?R:255;
        G = (G<255)?G:255;
        B = (B<255)?B:255;

        var RR = ((R.toString(16).length==1)?"0"+R.toString(16):R.toString(16));
        var GG = ((G.toString(16).length==1)?"0"+G.toString(16):G.toString(16));
        var BB = ((B.toString(16).length==1)?"0"+B.toString(16):B.toString(16));

        return "#"+RR+GG+BB;
    }
    function deeperColor(){
        signout.style.background = shadeColor(25);
    }
    function normalColor(){
        signout.style.background = color;
    }
    function deeperColorUser(){
        username.style.color = shadeColor(60);
    }
    function normalColorUser(){
        username.style.color = '#fff';
    }

</script>
<!-- //footer -->
<!-- start-smooth-scrolling -->
<script type="text/javascript" src="{{asset("frontend/js/move-top.js")}}"></script>
<script type="text/javascript" src="{{asset("frontend/js/easing.js")}}"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
        };
        */
        $().UItoTop({easingType: 'easeOutQuart'});
    });
</script>
<!-- //smooth-scrolling-of-move-up -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset("frontend/js/bootstrap.js")}}"></script>
</body>
</html>
