@extends('frontend/layout')
@section('content')
    <!-- Header and Links -->
    <link href="{{asset('frontend/css/profile.css')}}" type="text/css" rel="stylesheet" media="all">

    <div class="container-fluid">
        <div class="row">
            <div class=" col-sm-3">
                <div class="mt-4 row">
                    <div class="prof-container shadow-sm">
                        <img id="prof-pic" class="prof-pic" src="{{asset('frontend/images/head.png')}}">
                        <script>
                            var img = document.getElementById('prof-pic');
                        </script>
                        <div class="overlay">
                            <div class="prof-icon-div">
                                <i class="prof-icon fa fa-camera upload-button"></i>
                                <input class="file-upload" type="file" accept="image/*"/>
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
                    <button type="button" class=" shadow-sm btn btn-primary save-btn">Save</button>
                </div>
            </div>

            <div class="ml-3 panel-container mt-4 col-sm-8">
                <div id="panel1" class="mb-5 card">
                    <div class="card-header">
                        Personal Information
                    </div>

                    <!-- Name -->
                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">First and last name</span>
                        </div>
                        <input type="text" class="form-control" placeholder="First Name">
                        <input type="text" class="form-control" placeholder="Last Name">
                    </div>

                    <!-- Username -->
                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Username</span>
                        </div>
                        <input type="email" class="form-control" placeholder="Username" aria-label="email"
                               aria-describedby="basic-addon1">
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
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                   id="male" value="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                   id="female" value="female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                   id="female" value="female">
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
                                <input class="form-control phone-format" type="text" placeholder="Phone Number">
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
                        <input type="email" class="form-control" placeholder="123@example.xyz" aria-label="email"
                               aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Address</span>
                        </div>
                        <input type="text" class="form-control" placeholder="123 Street, City, State, Zip, Country "
                               aria-label="adress" aria-describedby="basic-addon1">
                    </div>
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
                </script>
            </div>

        </div>
    </div>
@endsection
