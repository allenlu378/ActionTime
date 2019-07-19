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
                <h1 class="mt-12 position-relative">Create a New Task!</h1>
                <form method="POST" action="">

                    <!-- Task Name -->
                    <div class="input-group mb-4 mt-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Task Name</span>
                        </div>
                        <input name='name' type="text" class="form-control" placeholder="Task Name"
                               aria-label="username"
                               aria-describedby="basic-addon1" required>
                    </div>

                    <!-- Text Description -->
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Task Description</span>
                        </div>
                        <textarea anem="description" class="form-control" aria-label="With textarea"
                                  required></textarea>
                    </div>

                    <!-- Task Total -->
                    <div class="input-group mb-4 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Total</span>
                        </div>
                        <input name='name' type="number" class="form-control" placeholder="Total" min="1" value="1"
                               required>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Occurrence
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Daily</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                </div>
                            </div>
                        </div>
                        <div class = 'col-md-6'>
                            <!-- Task Picture -->
                            <div class="pic">

                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                                            $('#imagePreview').hide();
                                            $('#imagePreview').fadeIn(650);
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#imageUpload").change(function () {
                                    readURL(this);
                                });
                            </script>
                        </div>
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