@extends('frontend/layout')
@section('content')

    <link href="{{asset('frontend/css/assign.css')}}" type="text/css" rel="stylesheet" media="all"
          xmlns:v-bind="http://www.w3.org/1999/xhtml">

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
                    <a href="{{route('task.list')}}"><img class="back-arrow float-left ml-4"
                                                          src= {{asset('frontend/images/back.png')}}></a>

                </div>
            </div>

            <h1>Assign a Task</h1>
            <form method="POST" action="{{route('task.edit')}}" enctype="multipart/form-data" class="w-100">
                @csrf
                <input name="id" class="d-none" id="task_id">
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
                                <input id="name_edit" name='name_edit' type="text"
                                       class="form-control {{ $errors->has('name_edit') ? ' is-invalid' : '' }}"
                                       aria-label="username"
                                       aria-describedby="basic-addon1" value="{{$task['name']}}" disabled>
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
                                <textarea id="desc_edit" name="description" class="form-control"
                                          aria-label="With textarea" value="{{$task['description']}}"
                                          disabled></textarea>
                            </div>
                        </div>
                        <div class="row row-input ml-5 mt-3">
                            <div class="col-md-4 w-75">
                                <!-- Task Total -->
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Total</span>
                                    </div>
                                    <input id="total_edit" name='total_value' type="number" class="form-control"
                                           min="1"
                                           value="{{$task['total_value']}}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-4 w-50 dropdown-col">
                                <!-- Dropdown -->
                                <div class="form-group list-input">
                                    <label for="sel1">Occurrence:</label>
                                    <select name="type" class="form-control" id="drop_edit" disabled>
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
                                    <input id="sugg_edit" name='suggested_times' type="number" class="form-control"
                                           min="1"
                                           value="{{$task['suggested_times']}}"
                                           disabled>
                                </div>
                            </div>

                        </div>
                        <div class="row ml-5 mr-0">
                            <div class="col-md-6 px-0">
                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Assign to Group</span>
                                    </div>
                                    <input id='group-search'
                                           class="form-control"
                                           autocomplete="randomString"
                                           placeholder="Group"
                                           aria-label="username"
                                           aria-describedby="basic-addon1">

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
                    </div>
                    <div class="row">
                        <button type='submit' class="shadow-sm btn btn-secondary save-btn">Assign Task</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        task = @json($task);
        groups = @json($groups);
        group_names = [];
        group_ids = [];
        for (let i = 0; i < groups.length; i++) {
            group_ids.push(groups[i]['id']);
            group_names.push(groups[i]['name']);
        }
        document.getElementById('drop_edit').value = task['type'];


        // else if(error_member && $( "#user-search" ).hasClass( "is-invalid" )){
        //     error_member = false;
        //     document.getElementById('modal_btn').click();
        // }


        function autocomplete(inp, arr) {
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
                a.setAttribute("class", "nav-item autocomplete-items");
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

                            /*make the matching letters bold:*/
                            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>" + "<span>" + arr[i].substr(val.length) + "</span>";
                            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                            b.addEventListener("click", function(e) {
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
                var x = document.getElementsByClassName("autocomplete-items");
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

        autocomplete(document.getElementById("group-search"), group_names);

    </script>

@endsection