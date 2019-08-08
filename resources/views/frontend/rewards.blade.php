@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/reward.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <div class="out-cont">
        <div class="container-fluid border mt-2 mt-4">
            <div class="front">
                <div class="row row-create">
                    <div class="col-lg-12">
                        <button type="button" id='create-btn' class="btn btn-info btn-lg float-right mt-3"
                                onclick="flip_y()">
                            New Reward
                        </button>
                    </div>

                </div>
                <div class="row row-content">
                    <h1 class="mb-5">Your Rewards</h1>

                </div>
                <div class="task-cont" id="reward-cont">
                    <div class="task-row">
                        <div class='col-md-4' v-for='reward in computed.rewards()'
                             v-bind:style="[reward.LastRow ? {'margin-bottom': '0'}:{'margin-bottom':'3rem'}]">
                            <div class="card task-background" v-bind:id="'card-'+reward.Name"
                                 v-bind:style="{ backgroundImage: 'url(../../../upload/'+reward.Image+')'}">
                                <div class="front-task">
                                    <div class="img-cont">
                                        <img class="card-img-top p-0">
                                    </div>
                                    <div class="card-footer">
                                        <h1 class="card-title">
                                            @{{ reward.DisplayName }}
                                        </h1>
                                    </div>

                                </div>
                                <div class="back-task">

                                    <h5 class="w-100 back-title-description">Description</h5>
                                    <div class="my-2 description">
                                        @{{ reward.Description }}
                                    </div>
                                    <div class="row attr-row mx-0">
                                        <div class="col px-0">
                                            <h5 class="back-title">Total</h5>
                                            @{{ reward.Total }}

                                        </div>
                                        <div class='vert-line'>
                                        </div>
                                        <div class="col px-0">
                                            <h5 class="back-title">Remaining</h5>
                                            @{{ reward.Remaining }}
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <h1 class="card-title">
                                            @{{ reward.DisplayName }}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row btn-row px-0" v-bind:id="'btns-'+reward.Name">
                                <div class="front-btns row w-100">

                                    <button v-bind:id="'edit-'+reward.Name" class="btn btn-primary w-100 btn-card-left">
                                        Edit
                                    </button>

                                </div>
                                <div class="back-btns row mx-0 w-100">
                                    <div class="col-sm-12 px-0">
                                        <form onsubmit="return confirm('Would you like to delete this reward?');"
                                              class="w-100" method="POST" action="{{route('reward.delete')}}">
                                            @csrf
                                            <input name="award_name" class="d-none" v-bind:value="reward.DisplayName">
                                            <button type="submit" class="btn btn-danger w-100 btn-card">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $(".btn-primary").each(function () {
                        $(this).on('click', function (e) {
                            flip_x();
                            card_id = $(this).attr('id');
                            reward_name = card_id.slice(5);
                            var reward_edit = getReward(reward_name);
                            $("#reward_id").val(reward_edit['Id']);
                            $("#name_edit").val(reward_edit['DisplayName']);
                            $("#desc_edit").val(reward_edit['Description']);
                            $("#total_edit").val(reward_edit['Total']);
                            $("#remaining").val(reward_edit['Remaining']);
                            $("#prof_pic_edit").attr("src", "../../../upload/" + reward_edit['Image']);


                        })

                    })
                });
                $(document).ready(function () {
                    $(".btn-success").each(function () {
                        var task_id = $(this).attr('id');
                        var task_name = task_id.slice(7);
                        task_name = task_name.split('-').join(' ');
                        $(this).attr('href', "assign/" + task_name);

                    })
                });
                $(document).ready(function () {
                    $(".card").each(function () {
                        $(this).on('click', function (e) {
                            card_id = "#" + $(this).attr('id');
                            btns_id = "#btns-" + card_id.slice(6);
                            $(card_id).toggleClass('task-flip');
                            $(btns_id).toggleClass('btns-flip');


                        })

                    })
                });


            </script>
            <div class="back-edit">
                <div class="row row-create">
                    <div class="col-lg-12 mx-0 px-0">
                        <button type="button" class="btn btn-info btn-lg float-right mt-3"
                                onclick="flip_y_back()">
                            Your Rewards

                        </button>
                    </div>

                </div>
                <div class="row row-content">
                    <h1>Edit Your Reward</h1>
                    <form method="POST" action="{{route('reward.edit')}}" enctype="multipart/form-data">
                        @csrf
                        <input name="id" class="d-none" id="reward_id">

                        <div class="row">
                            <div class="col-md-9 col-input">
                                <div class="row row-input ml-5 mt-2">
                                    <!-- Task Name -->
                                    <div class="input-group input-group-full mt-2 mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Name</span>
                                        </div>
                                        <input id="name_edit" name='name_edit' type="text"
                                               class="form-control {{ $errors->has('name_edit') ? ' is-invalid' : '' }}"
                                               placeholder="Name"
                                               aria-label="username"
                                               aria-describedby="basic-addon1" required>
                                        @if ($errors->has('name_edit'))
                                            <span class="ml-4_2 invalid-feedback" role="alert">
                                        <strong>Reward name has already been taken.</strong>
                                    </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="row row-input ml-5 mt-3">
                                    <!-- Text Description -->
                                    <div class="input-group input-group-full mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description</span>
                                        </div>
                                        <textarea id="desc_edit" name="description" class="form-control"
                                                  aria-label="With textarea"
                                                  placeholder="Description"
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="row row-input ml-5 mt-3">
                                    <div class="col-sm-6">
                                        <!-- Task Total -->
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Total</span>
                                            </div>
                                            <input id="total_edit" name='total_num' type="number" class="form-control"
                                                   placeholder="Total"
                                                   min="1"
                                                   value="1"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Task Remaining -->
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Remaining</span>
                                            </div>
                                            <input name='remaining_num' type="number"
                                                   class="form-control {{ $errors->has('remaining_num') ? ' is-invalid' : '' }}"
                                                   id="remaining"
                                                   placeholder="Remaining"
                                                   min="1"
                                                   value="1"
                                                   required>
                                            @if ($errors->has('remaining_num'))
                                                <span class="ml-9 invalid-feedback" role="alert">
                                        <strong>Remaining rewards cannot be greater than the total number.</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-3 pic-col mt-2">
                                <!-- Picture -->
                                <div class="row">
                                    <h3>Reward Picture</h3>
                                </div>
                                <div class="row">
                                    <div class="prof-container shadow-sm">
                                        <input type="image" id="prof_pic_edit" class="prof-pic"
                                               src="{{asset('frontend/images/task.png')}}">

                                        <div class="overlay">
                                            <div class="prof-icon-div">
                                                <i id="prof_icon_edit" class="prof-icon fa fa-camera upload-button"></i>
                                                <input name="img_edit" id="img_edit"
                                                       class="file-upload {{ $errors->has('img') ? ' is-invalid' : '' }}"
                                                       type="file"
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


                                                    $("#img_edit").on('change', function () {
                                                        readURL(this);
                                                    });

                                                    $("#prof_icon_edit").on('click', function () {
                                                        $("#img_edit").click();
                                                    });
                                                });
                                            </script>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    @if ($errors->has('img'))
                                        <span class="ml-7 invalid-feedback" role="alert">
                                        <strong>A task image is required.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <button type='submit' class="shadow-sm btn btn-secondary save-btn">Update Reward
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="back">

                <div class="row row-create">
                    <div class="col-lg-12">
                        <button type="button" id='back-btn' class="btn btn-info btn-lg float-right mt-3"
                                onclick="flip_y_back()">
                            Your Rewards

                        </button>
                    </div>

                </div>
                <div class="row row-content">
                    <h1>Create a New Reward!</h1>
                    <form method="POST" action="{{route('reward.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-9">
                                <div class="row row-input ml-5 mt-2 mr-0">
                                    <!-- Task Name -->
                                    <div class="input-group input-group-full mt-2 mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Name</span>
                                        </div>
                                        <input name='award_name' type="text"
                                               class="form-control {{ $errors->has('award_name') ? ' is-invalid' : '' }}"
                                               placeholder="Name"
                                               aria-label="username"
                                               aria-describedby="basic-addon1" required>
                                        @if ($errors->has('award_name'))
                                            <span class="ml-4_2 invalid-feedback" role="alert">
                                        <strong>Reward name has already been taken.</strong>
                                    </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="row row-input ml-5 mt-3 mr-0">
                                    <!-- Text Description -->
                                    <div class="input-group input-group-full mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description</span>
                                        </div>
                                        <textarea name="description" class="form-control" aria-label="With textarea"
                                                  placeholder="Description"
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="row row-input ml-5 mr-0 mt-3">
                                    <!-- Task Total -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Total</span>
                                        </div>
                                        <input name='total_num' type="number" class="form-control" placeholder="Total"
                                               min="1"
                                               value="1"
                                               required>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-3 pic-col mt-2">
                                <!-- Picture -->
                                <div class="row">
                                    <h3>Reward Picture</h3>
                                </div>
                                <div class="row">
                                    <div class="prof-container shadow-sm">
                                        <input type="image" id="prof-pic" class="prof-pic"
                                               src="{{asset('frontend/images/reward-img.png')}}">

                                        <div class="overlay">
                                            <div class="prof-icon-div">
                                                <i id="prof_icon" class="prof-icon fa fa-camera upload-button"></i>
                                                <input name="img" id="img"
                                                       class="file-upload {{ $errors->has('img_edit') ? ' is-invalid' : '' }}"
                                                       type="file"
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


                                                    $("#img").on('change', function () {
                                                        readURL(this);
                                                    });

                                                    $("#prof_icon").on('click', function () {
                                                        $("#img").click();
                                                    });
                                                });
                                            </script>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    @if ($errors->has('img_edit'))
                                        <span class="ml-7 invalid-feedback" role="alert">
                                        <strong>A task image is required.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <button type='submit' class="shadow-sm btn btn-secondary save-btn">Create Reward!
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <script>
                function flip_y() {
                    var back = document.getElementsByClassName('back')[0];
                    back.style.visibility = "visible";
                    var back_edit = document.getElementsByClassName('back-edit')[0];
                    back_edit.style.visibility = "hidden";
                    $(".container-fluid").addClass('flip-Y');
                }

                function flip_x() {
                    var back = document.getElementsByClassName('back')[0];
                    back.style.visibility = "hidden";
                    var back_edit = document.getElementsByClassName('back-edit')[0];
                    back_edit.style.visibility = "visible";
                    $(".container-fluid").addClass('flip-X');
                }

                function flip_y_back() {
                    $(".container-fluid").removeClass('flip-Y');
                    $(".container-fluid").removeClass('flip-X');
                }


            </script>


            <script>
                rewards_unparsed = @json($rewards);
                var rewards_list_db = [];

                function randomColor() {
                    var letters = '01234567';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 8)];
                    }
                    return color;
                }

                function getReward(name) {
                    for (index in rewards_list_db) {
                        if (rewards_list_db[index]['Name'] == name) {
                            return rewards_list_db[index];
                        }
                    }
                }

                length = rewards_unparsed.length;
                for (index in rewards_unparsed) {
                    var reward = {};
                    reward['Id'] = rewards_unparsed[index]['id'];
                    reward['DisplayName'] = rewards_unparsed[index]['award_name'];
                    reward['Name'] = rewards_unparsed[index]['award_name'].split(' ').join('-');
                    reward['Description'] = rewards_unparsed[index]['description'];
                    reward['Total'] = rewards_unparsed[index]['total_num'];
                    reward['Remaining'] = rewards_unparsed[index]['remaining_num'];

                    if (rewards_unparsed[index]['img'] == null) {
                        reward['Image'] = "../../../frontend/images/reward-img.png";
                    } else {
                        reward['Image'] = rewards_unparsed[index]['img'];
                    }
                    if (length - index <= 3) {
                        reward['LastRow'] = true;
                    } else {
                        reward['LastRow'] = false;
                    }
                    rewards_list_db.push(reward);
                }


                var rewardsVue = new Vue({
                    el: '#reward-cont',
                    data: {
                        rewards: [],
                        computed: {
                            rewards() {

                                return rewards_list_db;
                            },
                        }
                    }
                });

                for (let i = 0; i < $('.back-title-description').length; i++) {
                    var color = randomColor();
                    var element1 = document.getElementsByClassName('back-title-description')[i];
                    element1.style.backgroundColor = color;
                    var element2 = document.getElementsByClassName('back-title')[i * 2];
                    element2.style.backgroundColor = color;
                    var element3 = document.getElementsByClassName('back-title')[i * 2 + 1];
                    element3.style.backgroundColor = color;
                    var footer = document.getElementsByClassName('card-footer')[i * 2 + 1];
                    footer.style.backgroundColor = color;
                    var vert1 = document.getElementsByClassName('vert-line')[i];
                    vert1.style.borderLeft = "1px solid " + color;
                    var card = document.getElementsByClassName('back-task')[i];
                    card.style.border = "2px solid " + color;

                }
            </script>

        </div>
    </div>
    @if($errors->has('award_name'))
        <script>flip_y();</script>

    @elseif($errors->has('remaining_num'))
        @php $reward = $errors->first('reward_name') @endphp
        <script>
            error_reward = @json($reward);
            flip_x();
            var reward_edit = getReward(error_reward);
            $("#reward_id").val(reward_edit['Id']);
            $("#name_edit").val(reward_edit['DisplayName']);
            $("#desc_edit").val(reward_edit['Description']);
            $("#total_edit").val(reward_edit['Total']);
            $("#remaining").val(reward_edit['Remaining']);
            $("#prof_pic_edit").attr("src", "../../../upload/" + reward_edit['Image']);

        </script>


    @elseif($errors->has('name_edit'))
        @php $reward = $errors->first('reward_name') @endphp
        <script>
            error_reward = @json($reward);
            flip_x();
            var reward_edit = getReward(error_reward);
            $("#reward_id").val(reward_edit['Id']);
            $("#name_edit").val(reward_edit['DisplayName']);
            $("#desc_edit").val(reward_edit['Description']);
            $("#total_edit").val(reward_edit['Total']);
            $("#remaining").val(reward_edit['Remaining']);
            $("#prof_pic_edit").attr("src", "../../../upload/" + reward_edit['Image']);

        </script>
    @endif
    @if($errors->has('reward_del'))
        @php $reward_del = $errors->first('reward_del') @endphp
        <script>
            reward_del = @json($reward_del);
            window.onload = function(){
                window.alert("'"+reward_del + "' cannot be deleted because there are challenges associated with it.");
            };

        </script>
    @endif
@endsection