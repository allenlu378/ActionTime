@extends('frontend/assignlayout')
@section('content')

    <link href="{{asset('frontend/css/assign.css')}}" type="text/css" rel="stylesheet" media="all"
          xmlns:v-bind="http://www.w3.org/1999/xhtml">
    {{--    <script type="text/javascript"--}}
    {{--            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>--}}

    {{--    <link rel="stylesheet"--}}
    {{--          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>--}}

    {{--    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>



    @if($task['img'] == null)
        @php $task['img'] = "../../../frontend/images/task.png" @endphp
    @else
        @php $task['img'] = "../../../upload/".$task['img'] @endphp
    @endif
    @if($task['type'] == 0)
        @php $task['type'] = 'Daily' @endphp
    @elseif($task['type'] == 1)
        @php $task['type'] = 'Weekly' @endphp
    @else
        @php $task['type'] = 'Monthly'  @endphp
    @endif
    <div class="container-fluid mt-4 w-75">
        <div class="row row-content">
            <div class="row w-100 mx-0">
                <div class="col-lg-12">
                    <a href="{{route('task.list')}}"><img class="back-arrow float-left"
                                                          src= {{asset('frontend/images/back.png')}}></a>

                </div>
            </div>

            <h1 class="my-0">Assign a Task</h1>
            <form method="POST" action="{{route('task.assignTask')}}" enctype="multipart/form-data" class="w-100" id="form">
                @csrf
                <input name="id" class="d-none" id="task_id" value="{{$task['id']}}">
                <script>
                    function upload() {
                        $.post("FrontEnd/UtilController/upload()");
                    }
                </script>
                <div class="row">
                    <div class="col-md-9 col-input">
                        <div class="row row-input ml-5 mt-2">
                            <!-- Task Name -->
                            <div class="input-group input-group-full mt-2 mb-0">

                                <h4 id="basic-addon1">Name:</h4>
                                <input id="name_edit" name='name' type="text"
                                       class="form-control"
                                       aria-label="username"
                                       aria-describedby="basic-addon1" value="{{$task['name']}}" readonly>


                            </div>
                        </div>
                        <div class="row row-input ml-5 mt-3">
                            <!-- Text Description -->
                            <div class="input-group input-group-full mb-4">
                                <h4 id="basic-addon1">Description:</h4>
                                <textarea id="desc_edit" name="description" class="form-control"
                                          aria-label="With textarea"
                                          readonly>{{$task['description']}}</textarea>
                            </div>
                        </div>
                        <div class="row ml-5">
                            <div class="col-md-4 w-75 pl-0">
                                <!-- Task Total -->
                                <div class="input-group mb-0">
                                    <h4 id="basic-addon1">Total:</h4>
                                    <input id="total_edit" name='total_value' type="number" class="form-control"
                                           min="1"
                                           value="{{$task['total_value']}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 w-50">
                                <!-- Dropdown -->
                                <div class="form-group list-input">
                                    <h4 id="basic-addon1">Occurrence:</h4>
                                    <select name="type" class="form-control" id="drop_edit" disabled>
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                    </select>
                                </div>

                            </div>
                            <script>
                                jQuery(function ($) {
                                    $('#form').bind('submit', function () {
                                        $(this).find('#drop_edit').prop('disabled', false);
                                    });
                                });
                            </script>
                            <div class="col-md-4">
                                <!-- Task Suggested -->
                                <div class="input-group mb-0">
                                    <h4 id="basic-addon1">Suggested Split:</h4>

                                    <input id="sugg_edit" name='suggested_times' type="number" class="form-control"
                                           min="1"
                                           value="{{$task['suggested_times']}}"
                                           readonly>
                                </div>
                            </div>

                        </div>
                        <div class="row ml-5 mr-0 assign-row">
                            <h3 class="mb-0">Assign task:</h3>
                        </div>
                        <div class="row ml-5 mr-0" style="margin-top: -3%">
                            <div class="col-md-2">
                                <div class="custom-control custom-radio ml-4 mt-public">
                                    <input type="radio" class="custom-control-input m-auto" id="public" name="radio1"
                                           onchange="changeCheck()" style='height:50px; width: 50px' value=0>
                                    <label class="custom-control-label" for="public">Public</label>
                                </div>
                            </div>
                            <div class="col-md-1 px-0">
                                <div class="custom-control custom-radio mt-radio ml-4" style="padding-left: 5rem;">
                                    <input type="radio" class="custom-control-input" id="group" name="radio1"
                                           onchange="changeCheck()" value=1>
                                    <label class="custom-control-label" for="group" ></label>
                                </div>
                            </div>
                            <div class="col-md-4 px-0">
                                <div class="input-group mt-4">
                                    <h4 id="basic-addon1">Group:</h4>
                                    <input id='group-search' name = "group"
                                           class="form-control"
                                           autocomplete="RandomString1"
                                           placeholder="Group"
                                           aria-label="username"
                                           aria-describedby="basic-addon1" name="group">

                                </div>
                            </div>

                            <div class="col-md-1 px-0">
                                <div class="custom-control custom-radio mt-radio ml-4" style="padding-left: 5rem;">
                                    <input type="radio" class="custom-control-input float-left" id="user" name="radio1"
                                           onchange="changeCheck()" value=2>
                                    <label class="custom-control-label" for="user"></label>
                                </div>
                            </div>
                            <div class="col-md-4 px-0">
                                <div class="input-group mt-4">
                                    <h4 id="basic-addon1">User:</h4>
                                    <input id='user-search'
                                           class="form-control"
                                           autocomplete="Random1"
                                           placeholder="User"
                                           aria-label="username"
                                           aria-describedby="basic-addon1" name="user">

                                </div>
                            </div>

                        </div>

                        <script>
                            group_input = document.getElementById('group-search');
                            user_input = document.getElementById('user-search');
                            group_radio = document.getElementById('group');
                            user_radio = document.getElementById('user');
                            public_radio = document.getElementById('public');
                            group_input.focus();
                            group_radio.checked = true;
                            user_input.disabled = true;
                            group_input.required = true;

                            function changeCheck() {
                                group_input.value = "";
                                user_input.value = "";

                                if (group_radio.checked) {
                                    user_input.disabled = true;
                                    group_input.disabled = false;
                                    group_input.focus();
                                    group_input.required = true;
                                    user_input.required = false;
                                    return;
                                } else if (user_radio.checked) {
                                    user_input.disabled = false;
                                    user_input.focus();
                                    group_input.disabled = true;
                                    group_input.required = false;
                                    user_input.required = true;
                                    return;
                                } else if (public_radio.checked) {
                                    user_input.disabled = true;
                                    group_input.disabled = true;
                                    group_input.required = false;
                                    user_input.required = false;
                                    return;
                                }

                            }

                        </script>
                    </div>
                    <div class="col-md-3 pic-col">
                        <!-- Picture -->
                        <div class="row">
                            <h3>Task Picture</h3>
                        </div>
                        <div class="row">
                            <div class="prof-container shadow-sm">
                                <input type="image" id="prof_pic_edit" class="prof-pic"
                                       src="{{$task['img']}}">


                            </div>
                        </div>
                        <div class="row">
                            @if ($errors->has('img'))
                                <span class="ml-7 invalid-feedback" role="alert">
                                        <strong>A task image is required.</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row mt-1 due-row">
                            <h4 class="ml-5">Due Date:</h4>
                        </div>
                        <div class="row">

                            <div class="form-group mb-0">
                                <div class='input-group date' id='datetimepicker1'>

                                    <input name = 'due_time' type='text' class="form-control" required/>
                                    <div class="input-group-addon p-0"><span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-calendar" style="font-size:24px"></i>
                                            </span>

                                    <input name = 'due_time' data-format="dd/MM/yyyy hh:mm:ss" type='text' class="form-control" required/>
                                    <div class="input-group-addon p-0"><span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-calendar" style="font-size:24px"></i>
                                            </span></div>
                                </div>
                            </div>

                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker1').datetimepicker({
                                        format: 'MM/DD/YYYY hh:mm:ss A'
                                    });
                                });
                            </script>

                        </div>
                        <div class="row" style="margin-top: -11%">
                            <div class="form-group mb-0">
                                <div class="input-group">
                                    <h4 id="basic-addon1" style='margin-top: 15px; margin-bottom: 5px'>Reward:</h4>
                                    <input id='reward-search' name = "reward"
                                           class="form-control"
                                           autocomplete="randomString"
                                           placeholder="Reward"
                                           aria-label="username"
                                           aria-describedby="basic-addon1" required>
                                    <div class="input-group-addon p-0"
                                         style="vertical-align: bottom; background:none;border:none;"><span
                                                class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-trophy" style="font-size:24px"></i>
                                            </span></div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <button type='submit' class="shadow-sm btn btn-secondary save-btn">Assign Task</button>
                    </div>

            </form>
        </div>
    </div>

    <script>
        task = @json($task);
        groups = @json($groups);
        users = @json($users);
        rewards = @json($rewards);
        group_names = [];
        user_emails = [];
        user_ids = [];
        user_imgs = [];
        group_ids = [];
        reward_ids = [];
        reward_names = [];
        reward_imgs = [];
        for (let i = 0; i < groups.length; i++) {
            group_ids.push(groups[i]['id']);
            group_names.push(groups[i]['name']);
        }
        for (let i = 0; i < users.length; i++) {
            user_emails.push(users[i]['user_name']);
            user_ids.push(users[i]['id']);
            user_imgs.push(users[i]['img']);
        }
        for (let i = 0; i < rewards.length; i++) {
            reward_ids.push(rewards[i]['id']);
            reward_names.push(rewards[i]['award_name']);
            reward_imgs.push(rewards[i]['img']);
        }

        document.getElementById('drop_edit').value = task['type'];


        // else if(error_member && $( "#user-search" ).hasClass( "is-invalid" )){
        //     error_member = false;
        //     document.getElementById('modal_btn').click();
        // }


        function autocomplete(inp, arr, pics, imgs, reward) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function (e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }

                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "nav-item autocomplete-items-assign");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                var num_hints = 0;
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {


                        /*create a DIV element for each matching element:*/
                        if (num_hints > 2) {
                            continue;
                        } else {
                            b = document.createElement("DIV");
                            b.setAttribute("class", "hints");
                            var img = '';
                            if (pics) {
                                if (!reward && imgs[i] == null) {
                                    img = '../../../images/prof.png';
                                } else if (reward && imgs[i] == null) {
                                    img = '../../../frontend/images/reward-img.png';
                                }
                                else{
                                    img = '../../../upload/'+imgs[i];
                                }
                                b.innerHTML = "<img class = 'hint-pic' src = '" + img + "'>";
                                b.innerHTML += "<strong>" + arr[i].substr(0, val.length) + "</strong>" + "<span>" + arr[i].substr(val.length) + "</span>";
                            } else {
                                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>" + "<span>" + arr[i].substr(val.length) + "</span>";
                            }
                            /*make the matching letters bold:*/

                            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                            b.addEventListener("click", function (e) {
                                /*insert the value for the autocomplete text field:*/
                                inp.value = this.getElementsByTagName("input")[0].value;

                                /*close the list of autocompleted values,
                                (or any other open lists of autocompleted values:*/
                                closeAllLists();
                            });
                            /*insert a input field that will hold the current array item's value:*/
                            a.appendChild(b);
                            num_hints += 1;
                        }

                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function (e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });


            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items-assign");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });

            // Clear lists


        }

        autocomplete(document.getElementById("group-search"), group_names, false, [], false);
        autocomplete(document.getElementById("user-search"), user_emails, true, user_imgs, false);
        autocomplete(document.getElementById("reward-search"), reward_names, true, reward_imgs, true);

    </script>

@endsection
