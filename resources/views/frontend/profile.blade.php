@extends('frontend/layout')
@section('content')
    <!-- Header and Links -->
    <link href="{{asset('frontend/css/profile.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

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
        @php $address = $user['address'];
        $city = $user['city'];
        $state = $user['state'];
        $zip = $user['zip_code'];
        $country = $user['country'];
        @endphp
    @else
        @php $address = '' @endphp
    @endif
    @if($user['img'] != null)
        @php $image = '../../../upload/'.$user['img'] @endphp
    @else
        @php $image = "../../../frontend/images/head.png" @endphp
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class=" col-sm-3">
                <div class="row mt-4">
                    <h2>Profile Picture</h2>
                </div>
                <div class="row">
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
                        <a href="#panel2" id='nav2' class="border border-top-0 border-left-0 border-right-0">Rewards</a>

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
                            <input name='user_name' type="text"
                                   class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}"
                                   placeholder="Username"
                                   aria-label="username"
                                   aria-describedby="basic-addon1" value={{$user['user_name']}} required>
                            @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>This username has already been taken.</strong>
                                    </span>
                            @endif
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
                                   placeholder="Address"
                                   aria-label="adress" aria-describedby="basic-addon1" value='{{$address}}' required>
                            <input name='city' type="text" class="form-control"
                                   placeholder="City"
                                   aria-label="adress" aria-describedby="basic-addon1" value='{{$city}}' required>
                            <input name='state' type="text" class="form-control"
                                   placeholder="State"
                                   aria-label="adress" aria-describedby="basic-addon1" value='{{$state}}' required>
                            <input name='zip' type="text" class="form-control"
                                   placeholder="Zip"
                                   aria-label="adress" aria-describedby="basic-addon1" value='{{$zip}}' required>
                            <input name='country' type="text" class="form-control"
                                   placeholder="Country"
                                   aria-label="adress" aria-describedby="basic-addon1" value='{{$country}}' required>
                        </div>

                        <!-- Hidden Submit -->
                        <button type='submit' class="d-none" id='profile_update'></button>
                    </form>
                </div>

                <div id="panel2" class="card">
                    <div class="card-header mb-4">
                        Rewards
                    </div>
                    <div id="reward-cont" class="reward-cont row mx-0">
                        <div class='col-md-4 mb-4' v-for='reward in computed.rewards()'>
                            <div class="card reward-card" v-bind:style="{ backgroundImage: 'url(../../../upload/'+reward.Image+')'}">
                                <div class="img-cont">
                                    <img class="card-img-top p-0">
                                </div>
                                <div class="card-footer">
                                    <h1 class="card-title">
                                        <div class="row">
                                            <p class="text-white">@{{ reward.Name }}&nbsp; </p><p class="text-white" v-if="reward.Count > 1"> X @{{ reward.Count }}</p>
                                        </div>

                                    </h1>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
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
            <script>
                rewards = @json($rewards);
                rewards_list_db = [];
                reward = {};
                for (let i = 0; i < rewards.length; i++) {
                    reward = {};
                    reward['Id'] = rewards[i]['id'];
                    reward['Name'] = rewards[i]['award_name'];
                    reward['Image'] = rewards[i]['img'];
                    reward['Desc'] = rewards[i]['description'];
                    reward['Count']=rewards[i]['count'];
                    rewards_list_db.push(reward);
                }

                var rewards = new Vue({
                    el: '#reward-cont',
                    data: {
                        rewards: [],


                        computed: {
                            rewards() {
                                return rewards_list_db;
                            },


                        }
                    }
                })
            </script>

        </div>

    </div>
    </div>
@endsection
