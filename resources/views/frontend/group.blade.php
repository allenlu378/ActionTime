@extends('frontend/layout')
@section('content')
    {{--    <div class="nav-item">--}}
    {{--        <input id="friend-search" type="text" name="friend-search" placeholder="email">--}}
    {{--    </div>--}}
    <link href="{{asset('frontend/css/group.css')}}" type="text/css" rel="stylesheet" media="all">

    <div class="container-fluid mt-4">
        <div class="row mb-4">
            <div class="mt-4 mb-4 col-sm-3">
                <div class="row mt-5">
                    <div class="vertical-menu shadow-sm" id="scrollSpy">
                        <a href="#panel1" id='nav1' class="border border-top-0 border-left-0 border-right-0">Your
                            Groups</a>
                        <a href="#panel2" id='nav2' class="border border-top-0 border-left-0 border-right-0">Created by
                            You</a>
                        <a href="#panel3" id='nav3'
                           class=" border border-top-0 border-left-0 border-right-0">Invites</a>

                    </div>
                </div>
                <div class="row mt-5">
                    <button id="modal_btn"
                            type="button"
                            class="btn btn-primary btn-lg"
                            data-toggle="modal"
                            data-target="#createModal">
                        Create a Group!
                    </button>
                </div>

            </div>

            <div class="panel-container mt-4 col-sm-8">

                <div id="panel1" class="mb-5 card">
                    <div class="card-header">
                        Your Groups
                    </div>

                </div>

                <div id="panel2" class="card mb-5">
                    <div class="card-header">
                        Created By You
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div id="panel3" class="card">
                    <div class="card-header">
                        Invites
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class = "col-sm-1">
        </div>

    </div>

    <div class="modal fade" id="createModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Create a Group!</h1>
                </div>
                <form method="POST" action="{{route('group.create')}}">
                    @csrf
                    <div class="modal-body">

                        <!-- Group Name -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Group Name</span>
                            </div>
                            <input id="name" name='name' type="text"
                                   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="Name"
                                   aria-label="username"
                                   aria-describedby="basic-addon1" required>
                            @if ($errors->has('name'))
                                <span class="ml-7 invalid-feedback" role="alert">
                                        <strong>Group Name has already been taken.</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- Members -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Add Members</span>
                            </div>
                            <input id='user-search' type="text"
                                   class="form-control {{ $errors->has('member1') ? ' is-invalid' : '' }}"
                                   autocomplete="randomString"
                                   placeholder="User Email"
                                   aria-label="username"
                                   aria-describedby="basic-addon1">
                            @if ($errors->has('member1'))
                                <span class="ml-8 invalid-feedback" role="alert">
                                        <strong>A group needs to have at least one member.</strong>
                                    </span>
                            @endif
                        </div>

                        <h2 class='add-mem-lbl'>Added Members</h2>
                        <hr class="hor-bar">
                        <div class="add-mem-cont" id='member-cont'>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type='submit' class="shadow-sm btn btn-primary submit-btn">Create Group!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>



    <script>
        window.onload = function () {
            if ($("#name").hasClass("is-invalid")) {
                document.getElementById('modal_btn').click();

            }
        };


        // else if(error_member && $( "#user-search" ).hasClass( "is-invalid" )){
        //     error_member = false;
        //     document.getElementById('modal_btn').click();
        // }
        var ids = @json($ids);
        var emails = @json($emails);
        var pics = @json($pics);
        added_members = [];
        pic = "";

        function clear() {
            var cont = document.getElementById('member-cont');
            var length = cont.childNodes.length;
            for (var l = 0; l < length; l++) {
                cont.removeChild(cont.childNodes[0]);
            }
        }

        function list_members() {
            clear();
            for (let j = 0; j < added_members.length; j++) {
                i = added_members[j];
                c = document.createElement("DIV");
                c.setAttribute("class", "hints mb-3");
                if (pics[i] == null) {
                    pic = '../../../images/prof.png';
                } else {
                    pic = '../../../upload/' + pics[i];
                }
                /*make the matching letters bold:*/
                c.innerHTML = "<span class = 'mem-lbl mr-2 font-weight-light' >" + (j + 1) + ".</span>";
                c.innerHTML += "<img class = 'member-pic'>";
                c.innerHTML += "<input class = 'd-none'>";
                c.innerHTML += "<span class = 'font-weight-light'>" + emails[i] + "</span>";
                c.innerHTML += "<img class = 'remove-button mt-2' src = '../../../images/remove.png'>";
                document.getElementById('member-cont').appendChild(c);
                var len = document.getElementById('member-cont').childNodes.length;
                document.getElementsByClassName('d-none')[j].setAttribute('name', 'member' + (j + 1));
                document.getElementsByClassName('d-none')[j].setAttribute('value', ids[i]);
                document.getElementsByClassName('member-pic')[j].src = pic;
                document.getElementsByClassName('remove-button')[j].setAttribute('onclick', 'remove(' + i + ')');


            }
        }

        function remove(num) {
            for (k = 0; k < added_members.length; k++) {
                if (added_members[k] == num) {
                    added_members.splice(k, 1);
                    break;
                }
            }
            list_members();
        }

        function add(num) {
            added_members.push(num);
            document.getElementById('user-search').value = '';
            document.getElementById('user-search').focus();
            list_members();
        }


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
                        if (added_members.includes(i) || num_hints > 6) {
                            continue;
                        } else {
                            b = document.createElement("DIV");
                            b.setAttribute("class", "hints");
                            if (pics[i] == null) {
                                pic = '../../../images/prof.png';
                            } else {
                                pic = '../../../upload/' + pics[i];
                            }
                            /*make the matching letters bold:*/
                            b.innerHTML = "<img class = 'hint-pic'>";

                            b.innerHTML += "<strong>" + arr[i].substr(0, val.length) + "</strong>" + "<span>" + arr[i].substr(val.length) + "</span>";
                            /*insert a input field that will hold the current array item's value:*/
                            b.innerHTML += "<img class = 'add-button' src = '../../../images/add.png'>";
                            /*execute a function when someone clicks on the item value (DIV element):*/

                            a.appendChild(b);
                            document.getElementsByClassName('hint-pic')[num_hints].src = pic;
                            document.getElementsByClassName('add-button')[num_hints].setAttribute('onclick', 'add(' + i + ')');
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
        }

        autocomplete(document.getElementById("user-search"), emails);
    </script>
@endsection
