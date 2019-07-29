@extends('frontend/layout')
@section('content')

    <link href="{{asset('frontend/css/task.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <div class="container-fluid mt-2 border mt-4">
        <div class="front">
            <div class="row row-create">
                <div class="col-lg-12">
                    <button type="button" id='create-btn' class="btn btn-info btn-lg float-right mt-3"
                            onclick="flip_y()">
                        New Task

                    </button>
                </div>

            </div>
            <div class="row row-content">
                <h1 class="mb-5">Your Tasks</h1>

            </div>
            <div class="task-cont" id="task-cont">
                <div class="task-row">
                    <div class='col-md-4' v-for='task in computed.tasks()'
                         v-bind:style="[task.LastRow ? {'margin-bottom': '0'}:{'margin-bottom':'3rem'}]">
                        <div class="card task-background" v-bind:id="'card-'+task.Name"
                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+task.Image+')'}">
                            <div class="front-task">
                                <div class="img-cont">
                                    <img class="card-img-top p-0">
                                </div>
                                <div class="card-footer">
                                    <h1 class="card-title">
                                        @{{ task.Name }}
                                    </h1>
                                </div>

                            </div>
                            <div class="back-task">

                                <h5 class="w-100 back-title-description">Description</h5>
                                <div class="my-2 description">
                                    @{{ task.Description }}
                                </div>
                                <div class="row attr-row mx-0">
                                    <div class="col px-0">
                                        <h5 class="back-title">Total</h5>
                                        @{{ task.Total }}

                                    </div>
                                    <div class='vert-line'>
                                    </div>
                                    <div class="col px-0">
                                        <h5 class="back-title">Type</h5>
                                        @{{ task.Type }}
                                    </div>
                                </div>
                                <div class="row attr-row mx-0">
                                    <div class="col px-0">
                                        <h5 class="back-title">Portions</h5>
                                        @{{ task.Suggested }}

                                    </div>
                                    <div class='vert-line'>
                                    </div>
                                    <div class="col px-0">
                                        <h5 class="back-title">Average</h5>
                                        @{{ task.Average }}
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h1 class="card-title">
                                        @{{ task.Name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row btn-row px-0" v-bind:id="'btns-'+task.Name">
                            <div class="front-btns row w-100">
                                <div class="col-sm-6 px-0">
                                    <button v-bind:id = "'edit-'+task.Name" class="btn btn-primary w-100 btn-card-left">Edit</button>
                                </div>
                                <div class="col-sm-6 px-0">
                                    <button class="btn btn-success w-100 btn-card-right">Assign</button>
                                </div>
                            </div>
                            <div class="back-btns row mx-0 w-100">
                                <div class="col-sm-12 px-0">
                                    <form onsubmit="return confirm('Would you like to delete this task?');"
                                          class="w-100" method="POST" action="{{route('task.delete')}}">
                                        @csrf
                                        <input name="task_name" class="d-none" v-bind:value="task.Name">
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
                        task_name = card_id.slice(5);
                        var task_edit = getTask(task_name);
                        $("#task_id").val(task_edit['Id']);
                        $("#name_edit").val(task_edit['Name']);
                        $("#desc_edit").val(task_edit['Description']);
                        $("#total_edit").val(task_edit['Total']);
                        $("#drop_edit").val(task_edit['Type']);
                        $("#sugg_edit").val(task_edit['Suggested']);
                        $("#prof_pic_edit").attr("src", "../../../upload/"+task_edit['Image']);


                    })

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
                <div class="col-lg-12">
                    <button type="button" class="btn btn-info btn-lg float-right mt-3"
                            onclick="flip_y_back()">
                        Your Tasks

                    </button>
                </div>

            </div>
            <div class="row row-content">
                <h1>Edit Your Task</h1>
                <form method="POST" action="{{route('task.edit')}}" enctype="multipart/form-data">
                    @csrf
                    <input name = "id" class = "d-none" id="task_id">
                    <script>
                        function upload() {
                            $.post("FrontEnd/UtilController/upload()");
                        }
                    </script>
                    <div class="row">
                        <div class="col-md-9 col-input">
                            <div class="row row-input ml-5 mt-2">
                                <!-- Task Name -->
                                <div class="input-group input-group-full mt-2 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Name</span>
                                    </div>
                                    <input id = "name_edit" name='name_edit' type="text"
                                           class="form-control {{ $errors->has('name_edit') ? ' is-invalid' : '' }}"
                                           placeholder="Name"
                                           aria-label="username"
                                           aria-describedby="basic-addon1" required>
                                    @if ($errors->has('name_edit'))
                                        <span class="ml-4_2 invalid-feedback" role="alert">
                                        <strong>Task name has already been taken.</strong>
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
                                    <textarea id = "desc_edit" name="description" class="form-control" aria-label="With textarea"
                                              placeholder="Description"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="row row-input ml-5 mt-3">
                                <div class="col-md-4 w-75">
                                    <!-- Task Total -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Total</span>
                                        </div>
                                        <input id = "total_edit" name='total_value' type="number" class="form-control" placeholder="Total"
                                               min="1"
                                               value="1"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4 w-50 dropdown-col">
                                    <!-- Dropdown -->
                                    <div class="form-group list-input">
                                        <label for="sel1">Occurrence:</label>
                                        <select name="type" class="form-control" id="drop_edit">
                                            <option>Daily</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <!-- Task Suggested -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Suggested Split</span>
                                        </div>
                                        <input id = "sugg_edit" name='suggested_times' type="number" class="form-control"
                                               placeholder="Split"
                                               min="1"
                                               value="1"
                                               required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 pic-col mt-2">
                            <!-- Picture -->
                            <div class="row">
                                <h3>Task Picture</h3>
                            </div>
                            <div class="row">
                                <div class="prof-container shadow-sm">
                                    <input type="image" id="prof_pic_edit" class="prof-pic"
                                           src="{{asset('frontend/images/task.png')}}">

                                    <div class="overlay">
                                        <div class="prof-icon-div">
                                            <i id = "prof_icon_edit" class="prof-icon fa fa-camera upload-button"></i>
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
                            <button type='submit' class="shadow-sm btn btn-primary save-btn">Update Task</button>
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
                        Your Tasks

                    </button>
                </div>

            </div>
            <div class="row row-content">
                <h1>Create a New Task!</h1>
                <form method="POST" action="{{route('task.store')}}" enctype="multipart/form-data">
                    @csrf
                    <script>
                        function upload() {
                            window.alert('here');
                            $.post("FrontEnd/UtilController/upload()");
                        }
                    </script>
                    <div class="row">
                        <div class="col-md-9 col-input">
                            <div class="row row-input ml-5 mt-2">
                                <!-- Task Name -->
                                <div class="input-group input-group-full mt-2 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Name</span>
                                    </div>
                                    <input name='name' type="text"
                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           placeholder="Name"
                                           aria-label="username"
                                           aria-describedby="basic-addon1" required>
                                    @if ($errors->has('name'))
                                        <span class="ml-4_2 invalid-feedback" role="alert">
                                        <strong>Task name has already been taken.</strong>
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
                                    <textarea name="description" class="form-control" aria-label="With textarea"
                                              placeholder="Description"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="row row-input ml-5 mt-3">
                                <div class="col-md-4 w-75">
                                    <!-- Task Total -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Total</span>
                                        </div>
                                        <input name='total_value' type="number" class="form-control" placeholder="Total"
                                               min="1"
                                               value="1"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4 w-50 dropdown-col">
                                    <!-- Dropdown -->
                                    <div class="form-group list-input">
                                        <label for="sel1">Occurrence:</label>
                                        <select name="type" class="form-control" id="sel1">
                                            <option>Daily</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <!-- Task Suggested -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Suggested Split</span>
                                        </div>
                                        <input name='suggested_times' type="number" class="form-control"
                                               placeholder="Split"
                                               min="1"
                                               value="1"
                                               required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 pic-col mt-2">
                            <!-- Picture -->
                            <div class="row">
                                <h3>Task Picture</h3>
                            </div>
                            <div class="row">
                                <div class="prof-container shadow-sm">
                                    <input type="image" id="prof-pic" class="prof-pic"
                                           src="{{asset('frontend/images/task.png')}}">

                                    <div class="overlay">
                                        <div class="prof-icon-div">
                                            <i id = "prof_icon" class="prof-icon fa fa-camera upload-button"></i>
                                            <input name="img_edit" id="img"
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
                            <button type='submit' class="shadow-sm btn btn-primary save-btn">Create Task!</button>
                        </div>

                    </div>
                </form>
            </div>
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
    @if($errors->has('name'))
        <script>flip_y();</script>
    @endif
    @if($errors->has('name_edit'))
        <script>flip_x();</script>
    @endif
    <script>
        tasks_unparsed = @json($tasks);
        var tasks_list_db = [];

        function randomColor() {
            var letters = '01234567';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 8)];
            }
            return color;
        }
        function getTask(name){
            for(index in tasks_list_db){
                if(tasks_list_db[index]['Name'] == name){
                   return tasks_list_db[index];
                }
            }
        }

        length = tasks_unparsed.length;
        for (index in tasks_unparsed) {
            var task = {};
            task['Id'] = tasks_unparsed[index]['id'];
            task['Name'] = tasks_unparsed[index]['name'];
            task['Description'] = tasks_unparsed[index]['description'];
            task['Total'] = tasks_unparsed[index]['total_value'];
            task['Average'] = tasks_unparsed[index]['average_workload'];
            task['Suggested'] = tasks_unparsed[index]['suggested_times'];
            if (tasks_unparsed[index]['type'] == 0) {
                task['Type'] = 'Daily';
            } else if (tasks_unparsed[index]['type'] == 1) {
                task['Type'] = 'Weekly';
            } else {
                task['Type'] = 'Monthly';
            }
            if(tasks_unparsed[index]['img'] == null){
                task['Image'] = "../../../frontend/images/task.png";
            }
            else{
                task['Image'] = tasks_unparsed[index]['img'];
            }
            if (length - index <= 3) {
                task['LastRow'] = true;
            } else {
                task['LastRow'] = false;
            }
            tasks_list_db.push(task);
        }


        var tasksVue = new Vue({
            el: '#task-cont',
            data: {
                tasks: [],
                computed: {
                    tasks() {

                        return tasks_list_db;
                    },
                }
            }
        });

        for (let i = 0; i < $('.back-title-description').length; i++) {
            var color = randomColor();
            var element1 = document.getElementsByClassName('back-title-description')[i];
            element1.style.backgroundColor = color;
            var element2 = document.getElementsByClassName('back-title')[i * 4];
            element2.style.backgroundColor = color;
            var element3 = document.getElementsByClassName('back-title')[i * 4 + 1];
            element3.style.backgroundColor = color;
            var element4 = document.getElementsByClassName('back-title')[i * 4 + 2];
            element4.style.backgroundColor = color;
            var element5 = document.getElementsByClassName('back-title')[i * 4 + 3];
            element5.style.backgroundColor = color;
            var footer = document.getElementsByClassName('card-footer')[i * 2 + 1];
            footer.style.backgroundColor = color;
            var vert1 = document.getElementsByClassName('vert-line')[i * 2];
            vert1.style.borderLeft = "1px solid " + color;
            var vert2 = document.getElementsByClassName('vert-line')[i * 2 + 1];
            vert2.style.borderLeft = "1px solid " + color;
            var card = document.getElementsByClassName('back-task')[i];
            card.style.border = "2px solid " + color;
        }


    </script>
@endsection
