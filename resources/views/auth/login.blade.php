@extends('frontend/loginlayout')
@section('content')

    <div class="container pt-3">
        <div class="row">
            <h1>About ActionTime</h1>
        </div>
        <div class="row">
            <p class="desc">ActionTime is a planner that can be used to build habits and complete tasks.</p>
        </div>
        <div class="row">
            <div class="col-sm-3">
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
                    $(".left").hover(
                        function () {
                            var src = $(".gif").attr("src");
                            $(".gif").attr("src", src.replace(/\.png$/i, ".gif"));
                        },
                        function () {
                            var src = $(".gif").attr("src");
                            $(".gif").attr("src", src.replace(/\.gif$/i, ".png"));
                        });
                });
            </script>

            <div class="col-sm-3 mid-col">
                <div id="card2" onclick="expand()" class="card middle">
                    <div class="close hide">
                        <span onclick="collapse();" class="float-right pr-1 close-icon"
                              aria-hidden="true">&times;</span>
                    </div>

                    <!-- LOGIN -->
                    <div class="front">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="login-title pt-3">Login!</h2>

                            <!-- Email Login -->
                            <div id="email" class="form-group username pt-5">
                                <label for="usr" class="textbox-text pb-1">Email:</label>
                                <input type="email"
                                       class="form-control textbox {{ $errors->has('email_log') ? ' is-invalid' : '' }}"
                                       id="user" name='email_log' required>
                                @if ($errors->has('email_log'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_log') }}</strong>
                                    </span>
                                @endif
                                <h2 id = 'login-feedback' class = 'login-feedback'>The email and password you entered did not match.</h2>
                            </div>


                            <!-- Password Login -->
                            <div id="pass" class="form-group username mt-5 z-98">
                                <label for="usr" class="textbox-text pb-1">Password:</label>
                                <input name = "pass_log" type="password" class="form-control textbox {{ $errors->has('pass_log') ? ' is-invalid' : '' }}" id="pass" required>
                            </div>
                            @if ($errors->has('pass_log'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pass_log') }}</strong>
                                    </span>
                            @endif
                            <button type="submit" class="btn btn-info login-btn mt-10">Login</button>
                            <div class='login-footer mt-12'>
                                <p>Don't have an account? <a href="#" onclick="flip()">Sign up here!</a></p>
                            </div>
                        </form>
                    </div>




                    <!-- REGISTRATION -->
                    <div class="back">
                        <form method="POST" action="{{route('register')}}" aria-label="{{ __('Register') }}">
                            @csrf
                            <h2 class="login-title pt-3">Sign Up!</h2>
                            <div class="form-group username pt-5 z-99">
                                <label for="usr" class="textbox-text pb-1">Username:</label>
                                <input name="user_name" id="user_name" type="text" class="form-control textbox {{ $errors->has('user_name') ? ' is-invalid' : '' }}" id="create_user" required/>
                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group username mt-5 z-99">
                                <label for="usr" class="textbox-text pb-1">Email:</label>
                                <input name = "email" type="email" class="form-control textbox {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email_reg" required/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Password -->
                            <div class="form-group username z-99" id = "pass_div">
                                <label for="usr" class="textbox-text pb-1">Password:</label>
                                <input name = "password" type="password" class="form-control textbox {{ $errors->has('password') ? ' is-invalid' : '' }}" id="create_pass" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <script>
                                if($( "#create_pass" ).hasClass( "is-invalid" )) {
                                    document.getElementById('pass_div').style.setProperty('margin-top', '7.5rem', 'important');
                                    $("#card2").addClass('expand flip');


                                }
                                else
                                {
                                    console.log('valid');
                                    document.getElementById('pass_div').style.marginTop = '8rem !important';
                                }
                                if($( "#email_reg" ).hasClass( "is-invalid" )){
                                    $("#card2").addClass('expand flip');
                                }
                            </script>

                            <!-- Password Confirmation -->
                            <div class="form-group username mt-11 z-99">
                                <label for="usr" class="textbox-text pb-1">Confirm password:</label>
                                <input type="password" class="form-control textbox" id="password-confirm" name="password_confirmation" required>

                            </div>
                            <button type="submit" class="z-200 btn btn-info login-btn mt-15 ">Sign Up!</button>
                            <div class='login-footer mt-17 z-99'>
                                <p>Already have an account? <a href="#" onclick="flip()">Log in here!</a></p>
                            </div>
                        </form>
                    </div>
                    <img src="{{asset('frontend/images/login.png')}}" class="z-1 card-img-top" alt="...">
                    <div class="card-footer">
                        <h1 class="card-title">Login/Sign Up</h1>
                    </div>
                </div>
            </div>
            <script>
                function flip() {
                    $("#card2").toggleClass('flip');
                }

                function expand() {
                    var card = $(".card")[1];
                    var close = $(".close-icon")[0];
                    card.removeAttribute('onclick');
                    $("#card2").removeClass('collap');
                    $("body").removeClass('unblur');
                    $("#card2").addClass("expand");
                    $("body").addClass('blur');
                    setTimeout(function () {
                        close.setAttribute('onclick', 'collapse()');
                    }, 2000);
                }

                function collapse() {

                    var card = $(".card")[1];
                    var close = $(".close-icon")[0];
                    close.removeAttribute('onclick');
                    $("#card2").removeClass("expand");
                    $("body").removeClass('blur');
                    $("#card2").addClass("collap");
                    $("body").addClass("unblur");
                    $("#card2").removeClass('flip');
                    setTimeout(function () {
                        card.setAttribute('onclick', 'expand()');
                    }, 2000);

                }
            </script>

            <!-- Login Invalid Message -->
            @if($login_invalid)
                <script>
                    expand();
                    document.getElementById('login-feedback').style.setProperty('display', 'block');
                    document.getElementById('email').style.setProperty('padding-top', '2rem', 'important');
                </script>
            @endif


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




@endsection
