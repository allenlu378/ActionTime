@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/task.css')}}" type="text/css" rel="stylesheet" media="all">

    <div class="container-fluid mt-2 border mt-4">
        <div class = "front">
            <div class="row row-create">
                <div class = "col-lg-12">
                    <button type = "button" id = 'create-btn' class = "btn btn-info btn-lg float-right mt-3" onclick = "flip()">
                        New Task<span class="glyphicon glyphicon-plus ml-3" aria-hidden="true"></span>

                    </button>
                </div>

            </div>
            <div class="row row-content">
                <h1>Your Tasks</h1>
            </div>
        </div>
        <div class = "back">
            <div class = "col-lg-12">
                <button type = "button" id = 'go-back-btn' class = "btn btn-info btn-lg float-right mt-3" onclick = "flip()">
                    <span class="glyphicon glyphicon-menu-left3" aria-hidden="true"></span>Go Back
                </button>
            </div>
            <h1>Create a Task!</h1>
        </div>

    </div>
    <script>
        function flip() {
            $(".container-fluid").toggleClass('flip');
        }
    </script>
@endsection
