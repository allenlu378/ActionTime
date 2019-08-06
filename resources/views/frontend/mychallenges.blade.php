@extends('frontend/layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <div class="container-fluid">
        <div class="row">
            <h1>My Challenges</h1>
            <div class="col-md-12">
                <div class="row button-container mr-4">
                    <input class="btn btn-primary  float-right" type="button"
                           value="Sent Challenges" onclick="window.location.href= 'createdchallenges';"/>
                </div>
            </div>
        </div>
        <div id="my_challenge_container" class="row">
            <div class="col-md-12 pending-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Pending Challenges
                </h2>
                <div id="pending-challenge-container" class="row pending-challenge-row">
                    <div class="col-md-4" v-for="(pending,index) in pending_challenges" :key="index">
                        <div class="card my-challenge mt-2"
                             @click="pending_isFlipped.splice(index,1,!pending_isFlipped[index])">
                            <div class="row">
                                <div class="col cardBox">
                                    <div class="my-challenge-info card mt-0"
                                         :class="{ 'flip-challenge': pending_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden':pending_isFlipped[index]}"
                                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+pending.task.img+')'}">
                                            <img class="card-img-top p-0">
                                        </div>
                                        <div class="back" :class="{'card-hidden': !pending_isFlipped[index]}">
                                            <h5 class="w-100 back-title-description">Description</h5>
                                            <div class="description">
                                                @{{ pending.task.description }}
                                            </div>
                                            <div class="row attr-row mx-0">
                                                <div class="col px-0">
                                                    <h5 class="back-title sender-pend">Sender</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+pending.started_by.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ pending.started_by.user_name }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title reward-pend">Reward</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+pending.award.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ pending.award.award_name }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr size="4" class="mb-0 pending-hr">
                                            <div class="row pending-margin">
                                                <input class="btn btn-success  float-right" type="button"
                                                       value="Accept Challenge" @click.stop
                                                       @click="acceptPending(pending.id)"/>

                                            </div>
                                            {{--                                        <div class="row attr-row mx-0">--}}
                                            {{--                                            <div class="col px-0">--}}
                                            {{--                                                <h5 class="back-title">Total</h5>--}}
                                            {{--                                                @{{ task.Total }}--}}

                                            {{--                                            </div>--}}
                                            {{--                                            <div class='vert-line'>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col px-0">--}}
                                            {{--                                                <h5 class="back-title">Type</h5>--}}
                                            {{--                                                @{{ task.Type }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="row attr-row mx-0">--}}
                                            {{--                                            <div class="col px-0">--}}
                                            {{--                                                <h5 class="back-title">Portions</h5>--}}
                                            {{--                                                @{{ task.Suggested }}--}}

                                            {{--                                            </div>--}}
                                            {{--                                            <div class='vert-line'>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col px-0">--}}
                                            {{--                                                <h5 class="back-title">Average</h5>--}}
                                            {{--                                                @{{ task.Average }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="card-footer">--}}
                                            {{--                                            <h1 class="card-title">--}}
                                            {{--                                                @{{ task.DisplayName }}--}}
                                            {{--                                            </h1>--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="row my-2">--}}
                                            {{--                                            @{{ pending.task.description }}--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="row my-2">--}}
                                            {{--                                            Sender:  @{{ pending.started_by.user_name }}--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="row my-2">--}}
                                            {{--                                            Reward:  @{{ pending.award.award_name}}--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="row button-container my-2 mr-4">--}}
                                            {{--                                            <div class="col-md-12">--}}
                                            {{--                                                <input  class="btn btn-primary  float-right" type="button"--}}
                                            {{--                                                        value="Accept Challenge" @click.stop @click="acceptPending(pending.id)"/>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <h1 class="card-title">
                                    @{{ pending.task.name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row button-container my-2 mr-4">
                            <div class="col-md-12">
                                <input id="view-more-pending-button" class="btn btn-primary float-right" type="button"
                                       value="View More" @click="loadPendingChallenges()"
                                       v-if="pending_id!=1 && more_pending"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 current-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Current Challenges
                </h2>
                <div id="current-challenge-container" class="row current-challenge-row">
                    <div class="col-md-4" v-for="(current,index) in current_challenges" :key="index">
                        <div class="card my-challenge my-2"
                             @click="current_isFlipped.splice(index,1,!current_isFlipped[index])">
                            <div class="row">
                                <div class="col cardBox">
                                    <div class="my-challenge-info card mt-0"
                                         :class="{ 'flip-challenge': current_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden': current_isFlipped[index]}"
                                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+current.challenge.task.img+')'}">
                                            <img class="card-img-top p-0">
                                        </div>
                                        <div class="back" :class="{'card-hidden': !current_isFlipped[index]}">
                                            <h5 class="w-100 back-title-description current-desc">Description</h5>
                                            <div class="description-current">
                                                @{{ current.challenge.task.description }}
                                            </div>
                                            <div class="row attr-row mx-0">
                                                <div class="col px-0">
                                                    <h5 class="back-title sender-cur">Sender</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+current.challenge.started_by.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{
                                                            current.challenge.started_by.user_name }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title reward-cur">Reward</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+current.challenge.award.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ current.challenge.award.award_name
                                                            }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 times-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title start-cur">Start Date</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ current.start_time }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-date'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title due-cur">Due Date</h5>
                                                    <div class="row">

                                                        <p class="reward-txt"> @{{ current.challenge.due_time }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 ranking-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title rank-cur">Ranking</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ current.ranking }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-ranking'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title status-cur">Status</h5>
                                                    <div class="row">
                                                        <div class="rounded-circle challenge-finished-indicator-accepted mx-2 mt-1"></div>
                                                        <p class="reward-txt">In Progress</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-auto">
                                                <h5 class="back-title-description w-100 mb-2 cur-cur">Current
                                                    Progress</h5>
                                                <div class="progress col-md-8 mb-1 px-0">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="color: black;"
                                                         :style="{width: current.percent + '%'}"
                                                         :aria-valuenow=current.percent aria-valuemin="0"
                                                         aria-valuemax="100">@{{ current.percent }}%
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row attr-row mx-0 ranking-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title update-cur">Update Progress</h5>
                                                    <div class="row mt-2" style="color: white">
                                                        <input id="current-progress" type="number"
                                                               class="mr-1"
                                                               :value=current.current_value
                                                               :min=current.current_value
                                                               :max=current.challenge.task.total_value step="0.5" v-model="current_newValue[index]" @click.stop/>
                                                        <p style="color: white">
                                                            /@{{current.challenge.task.total_value}}</p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-progress'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title submit-cur">Submit Progress</h5>
                                                    <div class="row">
                                                        <input class="btn btn-success  float-right mb-1" type="button"
                                                               value="Submit Progress" @click.stop @click="submitChallengeProgress(current.id,current.current_value,index)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <h1 class="card-title">
                                    @{{ current.challenge.task.name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row button-container my-2 mr-4">
                            <div class="col-md-12">
                                <input id="view-more-current-button" class="btn btn-primary float-right" type="button"
                                       value="View More" @click="loadCurrentChallenges()"
                                       v-if="current_id!=1 && more_current"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 complete-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Completed Challenges
                </h2>
                <div id="complete-challenge-container" class="row complete-challenge-row">
                    <div class="col-md-4" v-for="(completed,index) in completed_challenges" :key="index">
                        <div class="card my-challenge my-2"
                             @click="completed_isFlipped.splice(index,1,!completed_isFlipped[index])">
                            <div class="row">
                                <div class="col cardBox">
                                    <div class="my-challenge-info card mt-0"
                                         :class="{ 'flip-challenge': completed_isFlipped[index] }">

                                        <div class="front" :class="{'card-hidden': completed_isFlipped[index]}"
                                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+completed.challenge.task.img+')'}">
                                            <img class="card-img-top p-0">
                                        </div>
                                        <div class="back" :class="{'card-hidden': !completed_isFlipped[index]}">
                                            <h5 class="w-100 back-title-description desc-com">Description</h5>
                                            <div class="description-current">
                                                @{{ completed.challenge.task.description }}
                                            </div>
                                            <div class="row attr-row mx-0">
                                                <div class="col px-0">
                                                    <h5 class="back-title sender-com">Sender</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+completed.challenge.started_by.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{
                                                            completed.challenge.started_by.user_name }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title reward-com">Reward</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+completed.challenge.award.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ completed.challenge.award.award_name
                                                            }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 times-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title start-com">Start Date</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ completed.start_time }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-date'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title due-com">Due Date</h5>
                                                    <div class="row">

                                                        <p class="reward-txt"> @{{ completed.challenge.due_time }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 ranking-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title rank-com">Ranking</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ completed.ranking }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-ranking'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title status-com">Status</h5>
                                                    <div class="row">
                                                        <div v-if="completed.finish_flag == 1" class = "rounded-circle challenge-finished-indicator-success mx-2">
                                                        </div>
                                                        <div v-else class="rounded-circle challenge-finished-indicator-fail mx-2">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-auto">
                                                <h5 class="back-title-description w-100 cur-com">Progress</h5>
                                                <div class="col-sm-4 px-0">
                                                    <div class="row" style="color: white">
                                                        <p style="color: white">
                                                            @{{ completed.current_value
                                                            }}/@{{completed.challenge.task.total_value}}</p>
                                                    </div>
                                                </div>
                                                <div class="progress col-sm-6 px-0 w-75 bar-margin">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="color: black;"
                                                         :style="{width: completed.percent + '%'}"
                                                         :aria-valuenow=completed.percent aria-valuemin="0"
                                                         aria-valuemax="100">@{{ completed.percent }}%
                                                    </div>
                                                </div>

                                            </div>

                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                @{{ completed.challenge.task.description }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Sender: @{{ completed.challenge.started_by.user_name }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Start Time: @{{ completed.start_time }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Due Time: @{{ completed.challenge.due_time }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Reward: @{{ completed.challenge.award.award_name }}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Current Progress: @{{ completed.current_value--}}
                                            {{--                                                }}/@{{completed.challenge.task.total_value}}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Percent Complete:--}}
                                            {{--                                                <div class="progress col-md-12 mx-8">--}}
                                            {{--                                                    <div class="progress-bar" role="progressbar"--}}
                                            {{--                                                         :style="{width: completed.percent + '%'}"--}}
                                            {{--                                                         :aria-valuenow=completed.percent aria-valuemin="0"--}}
                                            {{--                                                         aria-valuemax="100">@{{ completed.percent }}%--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Ranking: @{{completed.ranking}}--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="row my-2">--}}
                                            {{--                                                Finished: @{{ completed.finish_time }}--}}
                                            {{--                                                <div v-if="completed.finish_flag == 1"--}}
                                            {{--                                                     class="rounded-circle challenge-finished-indicator-success mx-2">--}}

                                            {{--                                                </div>--}}
                                            {{--                                                <div v-else--}}
                                            {{--                                                     class="rounded-circle challenge-finished-indicator-fail mx-2">--}}

                                            {{--                                                </div>--}}

                                            {{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <h1 class="card-title">
                                    @{{ completed.challenge.task.name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row button-container my-2 mr-4">
                            <div class="col-md-12">
                                <input id="view-more-completed-button" class="btn btn-primary float-right" type="button"
                                       value="View More" @click="loadCompletedChallenges()"
                                       v-if="completed_id!=1 && more_completed"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function randomColor() {
            var letters = '01234567';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 8)];
            }
            return color;
        }

        for (let i = 0; i < $('.pending-hr').length; i++) {
            var color = randomColor();
            var description = document.getElementsByClassName('back-title-description')[i];
            description.style.backgroundColor = color;
            var sender = document.getElementsByClassName('sender-pend')[i];
            sender.style.backgroundColor = color;
            var reward = document.getElementsByClassName('reward-pend')[i];
            reward.style.backgroundColor = color;

        }
        for (let i = 0; i < $('.sender-cur').length; i++) {
            var color = randomColor();
            var description_cur = document.getElementsByClassName('current-desc')[i];
            description_cur.style.backgroundColor = color;
            var sender_cur = document.getElementsByClassName('sender-cur')[i];
            sender_cur.style.backgroundColor = color;
            var reward_cur = document.getElementsByClassName('reward-cur')[i];
            reward_cur.style.backgroundColor = color;
            var start_cur = document.getElementsByClassName('start-cur')[i];
            start_cur.style.backgroundColor = color;
            var due_cur = document.getElementsByClassName('due-cur')[i];
            due_cur.style.backgroundColor = color;
            var rank_cur = document.getElementsByClassName('rank-cur')[i];
            rank_cur.style.backgroundColor = color;
            var status_cur = document.getElementsByClassName('status-cur')[i];
            status_cur.style.backgroundColor = color;
            var cur_cur = document.getElementsByClassName('cur-cur')[i];
            cur_cur.style.backgroundColor = color;
            var update_cur = document.getElementsByClassName('update-cur')[i];
            update_cur.style.backgroundColor = color;
            var submit_cur = document.getElementsByClassName('submit-cur')[i];
            submit_cur.style.backgroundColor = color;

        }
        for (let i = 0; i < $('.sender-com').length; i++) {
            var color = randomColor();
            var description_com = document.getElementsByClassName('desc-com')[i];
            description_com.style.backgroundColor = color;
            var sender_com = document.getElementsByClassName('sender-com')[i];
            sender_com.style.backgroundColor = color;
            var reward_com = document.getElementsByClassName('reward-com')[i];
            reward_com.style.backgroundColor = color;
            var start_com = document.getElementsByClassName('start-com')[i];
            start_com.style.backgroundColor = color;
            var due_com = document.getElementsByClassName('due-com')[i];
            due_com.style.backgroundColor = color;
            var rank_com = document.getElementsByClassName('rank-com')[i];
            rank_com.style.backgroundColor = color;
            var status_com = document.getElementsByClassName('status-com')[i];
            status_com.style.backgroundColor = color;
            var cur_com = document.getElementsByClassName('cur-com')[i];
            cur_com.style.backgroundColor = color;
            var update_com = document.getElementsByClassName('update-com')[i];
            update_com.style.backgroundColor = color;
            var submit_com = document.getElementsByClassName('submit-com')[i];
            submit_com.style.backgroundColor = color;

        }

    </script>

    <script>

        var my_challenges = new Vue({
            el: '#my_challenge_container',
            data: {
                pending_challenges: [],
                pending_id: '',
                pending_isFlipped: [],
                more_pending: true,

                current_challenges: [],
                current_id: '',
                current_isFlipped: [],
                current_newValue: [],
                more_current: true,

                completed_challenges: [],
                completed_id: '',
                completed_isFlipped: [],
                more_completed: true


            },
            methods: {
                loadPendingChallenges() {
                    let $this = this;
                    axios
                        .post('/mychallenges/pending/list', {
                            id: this.pending_id,
                            "_token": "{{ csrf_token() }}",
                        })
                        .then((response) => {
                            var currentLength = this.pending_challenges.length;
                            this.pending_challenges = this.pending_challenges.concat(response.data);
                            var numberAdded = this.pending_challenges.length - currentLength;
                            if (numberAdded == 0) {
                                this.more_pending = false;
                            } else {
                                this.pending_id = response.data[numberAdded - 1].id;

                                for (var i = 0; i < numberAdded; i++) {
                                    this.pending_isFlipped.push(false);
                                }
                            }

                        })

                },
                acceptPending(challenge_id) {

                    axios
                        .post('/mychallenges/pending/create', {
                            id: challenge_id,
                            "_token": "{{ csrf_token() }}",
                        })
                        .then((response) => {
                            window.location.replace(response.data);
                        })
                },

            loadCurrentChallenges() {
                let $this = this;
                axios
                    .post('/mychallenges/current/list', {
                        id: this.current_id,
                        "_token": "{{ csrf_token() }}",
                    })
                    .then((response) => {
                        var currentLength =this.current_challenges.length;
                        this.current_challenges=this.current_challenges.concat( response.data);
                        var numberAdded = this.current_challenges.length-currentLength;
                        if(numberAdded == 0)
                        {
                            this.more_current = false;
                        }
                        else {
                            this.current_id = response.data[numberAdded - 1].id;
                            for (var i = 0; i < numberAdded; i++) {
                                this.current_isFlipped.push(false);
                                this.current_newValue.push(parseInt(response.data[i].current_value));
                            }
                        }


                        })
                },
                loadCompletedChallenges() {
                    let $this = this;
                    axios
                        .post('/mychallenges/completed/list', {
                            id: this.completed_id,
                            "_token": "{{ csrf_token() }}",
                        })
                        .then((response) => {
                            var currentLength = this.completed_challenges.length;
                            this.completed_challenges = this.completed_challenges.concat(response.data);
                            console.log(response.data)
                            var numberAdded = this.completed_challenges.length - currentLength;
                            if (numberAdded == 0) {
                                this.more_completed = false;
                            } else {
                                this.completed_id = response.data[numberAdded - 1].id;
                                console.log(this.completed_id)
                                for (var i = 0; i < numberAdded; i++) {
                                    this.completed_isFlipped.push(false);
                                }
                            }



                    })
            },
            submitChallengeProgress(id,currentValue, index)
            {
                var newValue = this.current_newValue[index];
                axios
                    .post('/approvalrequest/create', {
                        id: id,
                        current_progress: currentValue,
                        new_value: newValue,
                        "_token": "{{ csrf_token() }}"
                    })
                    .then((response) => {
                        window.location.replace(response.data);
                    })

            }


            },

            mounted() {
                this.loadPendingChallenges()
                this.loadCurrentChallenges()
                this.loadCompletedChallenges()

            }
        })

    </script>

@endsection
