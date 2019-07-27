@extends('frontend/layout')
@section('content')
    <!-- Header and Links -->
    <link href="{{asset('frontend/css/profile.css')}}" type="text/css" rel="stylesheet" media="all">


    <!-- Fill in Info -->
    @if($user['first_name'] != null)
        @php $first_name = $user['first_name'] @endphp
    @else
        @php $first_name = '' @endphp
    @endif
    @if($user['last_name'] != null)
        @php $last_name = $user['last_name'] @endphp
    @else
        @php $last_name = '' @endphp
    @endif

    @if($user['cellphone'] != null)
        @php $cellphone = $user['cellphone'] @endphp
    @else
        @php $cellphone = '' @endphp
    @endif
    @if($user['address'] != null)
        @php $address = trim($user['address']).', '.trim($user['city']).', '.trim($user['zip_code']).', '.trim($user['state']).', '.trim($user['country'])@endphp
    @else
        @php $address = '' @endphp
    @endif
    @if($user['img'] != null)
        @php $image = '../../../upload/'.$user['img'] @endphp
    @else
        @php $image = "../../../images/prof.png" @endphp
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class=" col-sm-3">
                <div class="mt-4 row">
                    <div class="prof-container shadow-sm">
                        <input type="image" id="prof-pic" class="prof-pic"
                               src= {{$image}}>

                        <div class="overlay">
                            <div class="prof-icon-div">
                                <i class="prof-icon fa fa-camera upload-button"></i>
                                <input name="img" id="img" form='form'
                                       class="file-upload {{ $errors->has('img') ? ' is-invalid' : '' }}" type="file"
                                       accept="image/*">
                            </div>

                            <script>
                                $(document).ready(function () {


                                    var readURL = function (input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('.prof-pic').attr('src', e.target.result);

                                            };

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    };


                                    $(".file-upload").on('change', function () {
                                        readURL(this);
                                    });

                                    $(".prof-icon").on('click', function () {
                                        $(".file-upload").click();
                                    });
                                });
                            </script>
                        </div>
                    </div>

                </div>
                <div class="row">
                    @if ($errors->has('img'))
                        <span class="ml-7 invalid-feedback" role="alert">
                                        <strong>A profile picture is required.</strong>
                                    </span>
                    @endif
                </div>
                <div class="mt-4 mb-4 row">
                    <div class="vertical-menu shadow-sm" id="scrollSpy">
                        <a href="#panel1" id='nav1' class="border border-top-0 border-left-0 border-right-0">Personal
                            Information</a>
                        <a href="#panel2" id='nav2' class="border border-top-0 border-left-0 border-right-0">Authentication</a>
                        <a href="#panel3" id='nav3' class=" border border-top-0 border-left-0 border-right-0">Your
                            Groups</a>
                        <a href="#panel4" id='nav4' class="">Achievements</a>
                    </div>

                </div>

                <div class="row">
                    <label class="shadow-sm btn btn-primary save-btn" for='profile_update'>Save & Return to Home</label>
                </div>
            </div>

            <div class="ml-3 panel-container mt-4 col-sm-8">
                <div id="panel1" class="mb-5 card">
                    <div class="card-header">
                        Personal Information
                    </div>
                    <form id='form' method="POST" action="{{route('profile.update', [$user['id']])}}"
                          enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Name</span>
                            </div>
                            <input name='first_name' type="text" class="form-control" placeholder="First Name"
                                   value='{{$first_name}}' required>
                            <input name='last_name' type="text" class="form-control" placeholder="Last Name"
                                   value='{{$last_name}}' required>
                        </div>

                        <!-- Username -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Username</span>
                            </div>
                            <input name='user_name' type="text" class="form-control" placeholder="Username"
                                   aria-label="username"
                                   aria-describedby="basic-addon1" value={{$user['user_name']}} required>
                        </div>

                        <!-- Gender and Phone Number -->
                        <div class="row input-group mt-4">
                            <div class=" inner col-sm-6">

                                <!-- Gender -->
                                <div class="inner input-group mt-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Gender</span>
                                    </div>
                                    <div class="row radio-row">
                                        <div class="col-sm-5 radio-col">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="male" value="male" onclick="radio()" required>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="female" value="female" onclick="radio()">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="other" value="other" onclick="radio()">
                                                <label class="form-check-label" for="female">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner col-sm-6">

                                <!-- Phone Number -->
                                <div class=" inner input-group mt-4 float-right">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Phone</span>
                                    </div>
                                    <input name='cellphone' class="form-control phone-format" type="text"
                                           placeholder="Phone Number" autocomplete="randomString" value='{{$cellphone}}'
                                           required>
                                    <script>
                                        $(document).ready(function () {
                                            /***phone number format***/
                                            $(".phone-format").keypress(function (e) {
                                                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                                    return false;
                                                }
                                                var curchr = this.value.length;
                                                var curval = $(this).val();
                                                if (curchr == 3 && curval.indexOf("(") <= -1) {
                                                    $(this).val("(" + curval + ")" + "-");
                                                } else if (curchr == 4 && curval.indexOf("(") > -1) {
                                                    $(this).val(curval + ")-");
                                                } else if (curchr == 5 && curval.indexOf(")") > -1) {
                                                    $(this).val(curval + "-");
                                                } else if (curchr == 9) {
                                                    $(this).val(curval + "-");
                                                    $(this).attr('maxlength', '14');
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>


                        <!-- Email -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Email</span>
                            </div>
                            <input name='email' type="email" class="form-control" placeholder="123@example.xyz"
                                   aria-label="email"
                                   aria-describedby="basic-addon1" value={{$user['email']}} required>
                        </div>

                        <!-- Address -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Address</span>
                            </div>
                            <input name='address' type="text" class="form-control"
                                   placeholder="123 Street, City, State, Zip, Country "
                                   aria-label="adress" aria-describedby="basic-addon1" value='{{$address}}' required>
                        </div>

                        <!-- Hidden Submit -->
                        <button type='submit' class="d-none" id='profile_update'></button>
                    </form>
                </div>

                <div id="panel2" class="card mb-5">
                    <div class="card-header">
                        Authentication
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div id="panel3" class="card mb-5">
                    <div class="card-header">
                        Groups
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div id="panel4" class="card">
                    <div class="card-header">
                        Achievements
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <script>
                    function panel(panel_num) {

                        $('.panel-container').animate({
                                scrollTop: $("#panel" + panel_num).offset().top
                            },
                            'slow');
                        window.alert("#panel" + panel_num);
                    }

                    function radio() {
                        var radio = document.getElementsByClassName('form-check-label');
                        for (let i = 0; i < 3; i++) {
                            radio[i].style.color = 'rgb(164, 210, 59)';
                        }
                    }


                </script>
                @if($user['gender'] != null)
                    <script>
                        $(function () {
                            $('[name = "gender"]').val(['{{$user['gender']}}'])
                        });
                        radio();
                    </script>
                @endif

            </div>

        </div>
    </div>
@endsection
