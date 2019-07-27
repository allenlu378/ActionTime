@extends('frontend/layout')
@section('content')

    <link href="{{asset('frontend/css/task.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <div class="container-fluid mt-2 border mt-4">
        <div class="front">
            <div class="row row-create">
                <div class="col-lg-12">
                    <button type="button" id='create-btn' class="btn btn-info btn-lg float-right mt-3" onclick="flip()">
                        New Task

                    </button>
                </div>

            </div>
            <div class="row row-content">
                <h1 class="mb-5">Your Tasks</h1>

            </div>
            <div class="task-cont" id="task-cont">
                <div class="task-row">
                    <div class='col-md-4 mb-4' v-for='task in computed.tasks()'>
                        <div class="card mb-4 task-background" v-bind:id="'card-'+task.Name"
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
                                <div class = "row attr-row mx-0">
                                    <div class = "col px-0">
                                        <h5 class = "back-title">Total</h5>
                                        @{{ task.Total }}

                                    </div>
                                    <div class = 'vert-line'>
                                    </div>
                                    <div class = "col px-0">
                                        <h5 class = "back-title">Type</h5>
                                        @{{ task.Type }}
                                    </div>
                                </div>
                                <div class = "row attr-row mx-0">
                                    <div class = "col px-0">
                                        <h5 class = "back-title">Portions</h5>
                                        @{{ task.Suggested }}

                                    </div>
                                    <div class = 'vert-line'>
                                    </div>
                                    <div class = "col px-0">
                                        <h5 class = "back-title">Average</h5>
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
                    </div>
                </div>

            </div>
        </div>
        <script>
            $(document).ready(function () {
                $(".card").each(function () {
                    $(this).on('click', function (e) {
                        card_id = "#" + $(this).attr('id');
                        $(card_id).toggleClass('task-flip');


                    })

                })
            });
        </script>
        <div class="back">

            <div class="row row-create">
                <div class="col-lg-12">
                    <button type="button" id='back-btn' class="btn btn-info btn-lg float-right mt-3" onclick="flip()">
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
                                        <strong>Group Name has already been taken.</strong>
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
                                           src="{{asset('frontend/images/head.png')}}">

                                    <div class="overlay">
                                        <div class="prof-icon-div">
                                            <i class="prof-icon fa fa-camera upload-button"></i>
                                            <input name="img" id="img"
                                                   class="file-upload {{ $errors->has('img') ? ' is-invalid' : '' }}"
                                                   type="file"
                                                   accept="image/*">

                                        </div>

                                        <script>
                                            $pic_path = $("#prof-pic").attr('src');
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
                                        <strong>A task image is required.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <button type='submit' class="shadow-sm btn btn-primary save-btn">Create Task!</button>
                        </div>


                </form>
            </div>
        </div>

    </div>
    <script>
        function flip() {
            $(".container-fluid").toggleClass('flip');
        }
    </script>
    @if($errors->has('name'))
        <script>flip();</script>
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






        for (index in tasks_unparsed) {
            var task = {};
            task['Name'] = tasks_unparsed[index]['name'];
            task['Description'] = tasks_unparsed[index]['description'];
            task['Total'] = tasks_unparsed[index]['total_value'];
            task['Average'] = tasks_unparsed[index]['average_workload'];
            task['Suggested'] = tasks_unparsed[index]['suggested_times'];
            if(tasks_unparsed[index]['type'] == 0){
                task['Type'] = 'Daily';
            }
            else if(tasks_unparsed[index]['type'] == 1){
                task['Type'] = 'Weekly';
            }
            else{
                task['Type'] = 'Monthly';
            }
            task['Image'] = tasks_unparsed[index]['img'];
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
        for(let i=0;i<$('.back-title-description').length;i++){
            var color = randomColor();
            var element1 = document.getElementsByClassName('back-title-description')[i];
            element1.style.backgroundColor = color;
            var element2 = document.getElementsByClassName('back-title')[i*4];
            element2.style.backgroundColor = color;
            var element3 = document.getElementsByClassName('back-title')[i*4+1];
            element3.style.backgroundColor = color;
            var element4 = document.getElementsByClassName('back-title')[i*4+2];
            element4.style.backgroundColor = color;
            var element5 = document.getElementsByClassName('back-title')[i*4+3];
            element5.style.backgroundColor = color;
            var footer = document.getElementsByClassName('card-footer')[i*2+1];
            footer.style.backgroundColor = color;

        }


    </script>
@endsection
