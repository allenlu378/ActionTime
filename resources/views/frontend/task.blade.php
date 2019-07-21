@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/task.css')}}" type="text/css" rel="stylesheet" media="all">

    <div class="container-fluid mt-2 border mt-4 flip">
        <div class="front">
            <div class="row row-create">
                <div class="col-lg-12">
                    <button type="button" id='create-btn' class="btn btn-info btn-lg float-right mt-3" onclick="flip()">
                        New Task

                    </button>
                </div>

            </div>
            <div class="row row-content">
                <h1>Your Tasks</h1>
            </div>
        </div>
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
                        function upload(){
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
                                    <input name='name' type="text" class="form-control" placeholder="Name"
                                           aria-label="username"
                                           aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="row row-input ml-5 mt-3">
                                <!-- Text Description -->
                                <div class="input-group input-group-full mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea name="description" class="form-control" aria-label="With textarea"
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
                                        <select name = "type" class="form-control" id="sel1">
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
                                        <input name='suggested_times' type="number" class="form-control" placeholder="Split"
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
                                            <input name = "img" id="img" class="file-upload" type="file"
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
                        </div>
                    </div>
                    <div class="row">
                        <button type = 'submit' class="shadow-sm btn btn-primary save-btn">Create Task!</button>
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
@endsection
