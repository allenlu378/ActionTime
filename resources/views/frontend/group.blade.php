@extends('frontend/layout')
@section('content')
    {{--    <div class="nav-item">--}}
    {{--        <input id="friend-search" type="text" name="friend-search" placeholder="email">--}}
    {{--    </div>--}}
    @php $group_id = "" @endphp
    <link href="{{asset('frontend/css/group.css')}}" type="text/css" rel="stylesheet" media="all"
          xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <div class="container-fluid mt-4">
        <div class="row mb-4">
            <div class="mt-4 mb-4 col-sm-3">
                <div class="row mt-5">
                    <div class="vertical-menu shadow-sm" id="scrollSpy">
                        <a href="#panel1" id='nav1' class="border border-top-0 border-left-0 border-right-0">Created by
                            You</a>
                        <a href="#panel2" id='nav2' class="border border-top-0 border-left-0 border-right-0">Your
                            Groups</a>


                    </div>
                </div>
                <div class="row mt-5">
                    <button id="modal_btn"
                            type="button"
                            class="btn btn-primary btn-lg"
                            data-toggle="modal"
                            data-target="#createModal"
                            onclick="clear_empty()">
                        Create a Group!
                    </button>
                </div>

            </div>


            <div class="panel-container col-sm-8" id='panel-container'>

                <div id="panel1" class="mb-5 card">
                    <div class="card-header mb-4">
                        Created By You
                    </div>
                    <div class="group-cont">
                        <div class="group-row row">
                            <div class='col-md-4 group mb-3' v-for='group in computed.createdGroups()'>
                                <div class="h-75 panel-card card mb-1-5" v-bind:id="group.Id">

                                    <div class="front">
                                        <div class="group-header card-header mb-3">
                                            @{{ group.Name }}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 btn-col">
                                                <button v-bind:id="'edit-' + group.Id"
                                                        class="btn btn-primary group-btn ml-3" data-toggle="modal"
                                                        data-target="#editModal">Edit
                                                </button>
                                            </div>
                                            <div class="col-md-6 btn-col">
                                                <button v-bind:id="'btn-' + group.Id"
                                                        class="btn btn-info group-btn mr-3">
                                                    Members
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <form onsubmit="return confirm('Would you like to delete this group?');"
                                                  class="delete_form" method="POST" action="{{route('group.delete')}}">
                                                @csrf
                                                <input name="group_id" class="display-none" v-bind:value="group.Id">
                                                <button type="submit" v-bind:id="'delete-' + group.Id"
                                                        class="btn btn-danger group-btn">Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="back back-click" v-bind:id="'back-' + group.Id">
                                        <div class="sticky-top">
                                            <div class="group-header-back card-header">
                                                @{{ group.Name }}
                                            </div>
                                        </div>

                                        <div class="mx-0 hints mem-list ml-2 w-100"
                                             v-bind:id="'list-' + computed.list_count()"
                                             v-for="member in group.Members">
                                            <span class='mem-lbl mr-2 font-weight-light'>@{{computed.list_count()}}.</span>
                                            <img class='member-prof img-list mt-1'
                                                 v-bind:src="'../../../upload/' + member.Image">
                                            <span class='font-weight-light'>@{{ member.Username }}</span>
                                            @{{computed.count() }}
                                        </div>


                                        @{{ computed.clear() }}
                                    </div>


                                </div>


                            </div>

                        </div>
                    </div>

                </div>

                <div id="panel2" class="card">
                    <div class="card-header mb-3">
                        Your Groups
                    </div>
                    <div class="group-cont">
                        <div class="group-row row">

                            <div class='col-md-4 mb-4 group' v-for='group in computed.memberGroups()'>
                                <div class="panel-card-2 card mb-2-5" v-bind:id="group.Id">
                                    <div class="front">
                                        <div class="group-header card-header mb-1">
                                            @{{ group.Name }}
                                        </div>
                                        <div class="row">
                                            <h4>Group Manager:</h4>
                                        </div>
                                        <div class="row ml-2">
                                            <div class="col-sm-2 px-0">
                                                <img class='manager-pic'
                                                     v-bind:src="'../../../upload/'+group.ManagerPic">
                                            </div>
                                            <div class="col-sm-10 px-0 mt-2 text-left">
                                                @{{ group.Manager }}

                                            </div>
                                        </div>
                                        <hr class="mt-1 mb-3">
                                        <div class="row mb-3">
                                            <div class="col-md-6 btn-col">
                                                <form onsubmit="return confirm('Would you like to leave this group?');"
                                                      class="leave_form" method="POST"
                                                      action="{{route('group.leave')}}">
                                                    @csrf
                                                    <input name="group_id" class="display-none" v-bind:value="group.Id">
                                                    <button v-bind:id="group.Id"
                                                            class="btn btn-danger group-btn ml-3">Leave
                                                    </button>
                                                </form>

                                            </div>
                                            <div class="col-md-6 btn-col">
                                                <button v-bind:id="'btn-' + group.Id"
                                                        class="btn btn-info group-btn mr-3">
                                                    Members
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="back back-click" v-bind:id="'back-' + group.Id">
                                        <div class="sticky-top">
                                            <div class="group-header-back card-header">
                                                @{{ group.Name }}
                                            </div>

                                        </div>
                                        <div class="list-members">
                                            <div class="mx-0 hints mem-list ml-2 w-100"
                                                 v-bind:id="'list-' + computed.list_count()"
                                                 v-for="member in group.Members">
                                                <span class='mem-lbl mr-2 font-weight-light'>@{{computed.list_count()}}.</span>
                                                <img class='member-prof img-list mt-1'
                                                     v-bind:src="'../../../upload/' + member.Image">
                                                <span class='font-weight-light'>@{{ member.Username }}</span>
                                                @{{computed.count() }}
                                            </div>


                                        </div>
                                        @{{ computed.clear() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <script>

                group_id = 0;
                $(document).ready(function () {
                    $(".btn-info").each(function () {
                        $(this).on('click', function (e) {
                            var btn_id = $(this).attr('id');
                            var card_id = "#" + btn_id.slice(4);
                            $(card_id).toggleClass('group-flip');


                        })

                    })
                });
                $(document).ready(function () {
                    $(".back-click").each(function () {
                        $(this).on('click', function (e) {
                            var btn_id = $(this).attr('id');
                            var card_id = "#" + btn_id.slice(5);
                            $(card_id).toggleClass('group-flip');


                        })

                    })
                });
                $(document).ready(function () {
                    $(".btn-primary").each(function () {
                        $(this).on('click', function (e) {
                            var btn_id = $(this).attr('id');
                            group_id = btn_id.slice(5);

                        })

                    })
                });


            </script>
        </div>
        <div class="col-sm-1">
        </div>

    </div>
    <div class="modal fade" id="editModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Edit a Group</h1>
                </div>
                <form method="POST" action="{{route('group.edit')}}">
                    @csrf
                    <div class="modal-body">

                        <!-- Group ID -->
                        <input name="id" class="display-none" id="group_id">

                        <!-- Group Name -->
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Group Name</span>
                            </div>
                            <input id="name_edit" name='name_edit' type="text"
                                   class="form-control {{ $errors->has('name_edit') ? ' is-invalid' : '' }}"
                                   placeholder="Name"
                                   aria-label="username"
                                   aria-describedby="basic-addon1" required>
                            @if ($errors->has('name_edit'))
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
                            <input id='user-search-edit' type="text"
                                   class="form-control {{ $errors->has('member-edit1') ? ' is-invalid' : '' }}"
                                   autocomplete="randomString1"
                                   placeholder="Username"
                                   aria-label="username"
                                   aria-describedby="basic-addon1">
                            @if ($errors->has('member-edit1'))
                                <span class="ml-8 invalid-feedback" role="alert">
                                        <strong>A group needs to have at least one member.</strong>
                                    </span>
                            @endif
                        </div>

                        <h2 class='add-mem-lbl'>Members</h2>
                        <hr class="hor-bar">
                        <div class="add-mem-cont" id='member-cont-edit'>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type='submit' class="shadow-sm btn btn-primary submit-btn">Update Group</button>
                    </div>
                </form>
            </div>
        </div>
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
                                   autocomplete="new-user"
                                   placeholder="Username"
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


    <script>
        var group_sizes = Object.values(@json($group_sizes));
        var group_info = @json($group_info);
        var num_groups = @json($num_groups);
        var email = @json($email);
        user_name = @json($user_name);
        var created = false;
        group = {};
        member = {};
        var created_groups_list_db = [];
        var member_groups_list_db = [];

        function parseMember(item) {
            item = Object.values(item);
            //User is manager
            if (item[4] == 2 && item[1] == email) {
                group['Manager'] = user_name;
                group['ManagerPic'] = item[5];
                group['Id'] = item[2];
                group['Name'] = item[3];
                created = true;

            }

            //Manager
            else if (item[4] == 2) {
                group['Manager'] = item[0];
                group['ManagerPic'] = item[5];
                group['Id'] = item[2];
                group['Name'] = item[3];
            }


            member['Image'] = item[5];
            member['Email'] = item[1];
            member['Username'] = item[0];
        }

        var k = 0;
        for (let i = 0; i < num_groups; i++) {
            group = {};
            group['Members'] = [];
            var stop = group_sizes[i] + k;
            for (j = k; j < stop; j++) {
                parseMember(group_info[k]);
                k = k + 1;
                group['Members'].push(member);
                member = {};

            }
            //window.alert(i + "    " + (num_created-i));


            if (created) {
                created_groups_list_db.push(group);
            } else {
                member_groups_list_db.push(group);
            }
            created = false;
        }
        var count = 1;
        var public_challenges = new Vue({
            el: '#panel-container',
            data: {
                createdGroups: [],
                memberGroups: [],


                computed: {
                    createdGroups() {
                        return created_groups_list_db;
                    },
                    memberGroups() {
                        return member_groups_list_db;
                    },
                    list_count() {
                        return count;
                    },
                    count() {
                        count += 1;
                    },
                    clear() {
                        count = 1;
                    }


                }
            }
        })
    </script>
    <script>


        // else if(error_member && $( "#user-search" ).hasClass( "is-invalid" )){
        //     error_member = false;
        //     document.getElementById('modal_btn').click();
        // }

        var ids = @json($ids);
        var emails = @json($emails);
        var pics = @json($pics);
        email = @json($email);
        added_members = [];
        pic = "";
        $(document).ready(function () {
            $(".btn-primary").each(function () {
                $(this).on('click', function (e) {
                    var btn_id = $(this).attr('id');
                    var group_id = btn_id.slice(5);
                    document.getElementById('group_id').value = group_id;

                })

            })
        });

        function clear_empty() {
            empty();
            clear('');
        }

        function clear(edit) {
            var cont_name = "member-cont" + edit;
            var cont = document.getElementById(cont_name);
            var length = cont.childNodes.length;
            for (var l = 0; l < length; l++) {
                cont.removeChild(cont.childNodes[0]);
            }
        }

        function empty() {
            added_members = [];
        }

        function list_members(edit) {
            clear(edit);
            var num_members = 0;
            for (let j = 0; j < added_members.length; j++) {
                i = added_members[j];
                c = document.createElement("DIV");
                c.setAttribute("class", "hints mb-3");
                if (emails[i] == user_name) {
                    continue;
                }
                if (pics[i] == null) {
                    pic = '../../../images/prof.png';
                } else {
                    pic = '../../../upload/' + pics[i];
                }

                /*make the matching letters bold:*/
                c.innerHTML = "<span class = 'mem-lbl mr-2 font-weight-light' >" + (num_members + 1) + ".</span>";
                c.innerHTML += "<img class = 'member-pic" + edit + "'>";
                c.innerHTML += "<input class = 'd-none " + edit + "'>";
                c.innerHTML += "<span class = 'font-weight-light'>" + emails[i] + "</span>";
                c.innerHTML += "<img class = 'remove-button" + edit + " mt-2' src = '../../../images/remove.png'>";
                var cont = "member-cont" + edit;
                document.getElementById(cont).appendChild(c);
                var none = "d-none " + edit;
                var remove_name = 'remove-button' + edit;
                var pic_ele = 'member-pic' + edit;
                document.getElementsByClassName(none)[num_members].setAttribute('name', 'member' + edit + (num_members + 1));
                document.getElementsByClassName(none)[num_members].setAttribute('value', ids[i]);
                document.getElementsByClassName(pic_ele)[num_members].src = pic;
                document.getElementsByClassName(remove_name)[num_members].setAttribute('onclick', "remove(" + i + ", '" + edit + "')");
                num_members += 1;

            }
        }

        function remove(num, edit) {
            for (k = 0; k < added_members.length; k++) {
                if (added_members[k] == num) {
                    added_members.splice(k, 1);
                    break;
                }
            }
            list_members(edit);
        }

        function add(num) {
            added_members.push(num);
            document.getElementById('user-search').value = '';
            document.getElementById('user-search').focus();
            list_members('');
        }

        function add_edit(num) {
            added_members.push(num);
            document.getElementById('user-search-edit').value = '';
            document.getElementById('user-search-edit').focus();
            list_members('-edit');
        }


        function autocomplete(inp, arr, edit) {
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
                if ($("#user-search").hasClass("is-invalid")) {
                    var list = document.getElementById('user-searchautocomplete-list');
                    list.style.marginTop = '-5%';
                }
                if ($("#user-search-edit").hasClass("is-invalid")) {
                    var list2 = document.getElementById('user-search-editautocomplete-list');
                    list2.style.marginTop = '-5%';
                }
                /*for each item in the array...*/
                var num_hints = 0;
                for (i = 0; i < arr.length; i++) {
                    if (arr[i] == user_name) {
                        continue;
                    }
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
                            var onclick = 'add' + edit + '(' + i + ')';
                            document.getElementsByClassName('add-button')[num_hints].setAttribute('onclick', onclick);
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
            $(document).click(function (event) {
                $target = $(event.target);
                if (!$target.closest('.modal').length &&
                    !$target.closest('.add-button').length && !$target.closest('.remove-button').length && !$target.closest('.remove-button-edit').length && !$target.closest('.btn-primary').length) {
                    added_members = [];
                    pic = "";
                    empty();

                }
            });

        }

        autocomplete(document.getElementById("user-search"), emails, '');
        autocomplete(document.getElementById("user-search-edit"), emails, '_edit');
    </script>
    <script>

        window.onload = function () {
            if ($("#name_edit").hasClass("is-invalid") || $("#user-search-edit").hasClass("is-invalid")) {
                        @php $group = $errors->first('group_id') @endphp
                var group_id = @json($group);
                var btn_id = 'edit-' + group_id;
                document.getElementById(btn_id).click();

            }
            if ($("#name").hasClass("is-invalid") || $("#user-search").hasClass("is-invalid")) {
                document.getElementById('modal_btn').click();
                @php $group_name = $errors->first('group_name') @endphp
                var group_name = @json($group_name);
                document.getElementById('name').value = group_name;


            }
        };
        $(document).on("click", ".btn-primary", function () {
            var group_id = $(this).attr('id').slice(5);
            for (let j = 0; j < created_groups_list_db.length; j++) {
                if (group_id == created_groups_list_db[j]['Id']) {
                    $('#name_edit').val(created_groups_list_db[j]['Name']);
                    empty();
                    for (let k = 0; k < created_groups_list_db[j]['Members'].length; k++) {
                        var index = emails.indexOf(created_groups_list_db[j]['Members'][k]['Username']);
                        add_edit(index);
                    }
                    break;
                }

            }
        });
    </script>


@endsection
