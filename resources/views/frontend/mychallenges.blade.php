@extends('frontend/layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <div class="container-fluid">
        <div class="row">
            <h1>My Challenges</h1>
        </div>
        <div id="my_challenge_container" class="row">
            <div class="col-md-12 pending-challenges my-challenge-headings">
            <h2 class="mx-5">
                Pending Challenges
            </h2>
            <div id="pending-challenge-container" class="row pending-challenge-row">
                <div class="col-md-4" v-for="(pending,index) in pending_challenges" :key="index">
                    <div class="card my-challenge my-2" @click="pending_isFlipped.splice(index,1,!pending_isFlipped[index])">
                        <div class="row">
                            <div class="col cardBox">
                                <div class="my-challenge-info card" :class="{ 'flip-challenge': pending_isFlipped[index] }">
                                    <div class="front" :class="{'card-hidden':pending_isFlipped[index]}">
                                        <img class="card-img-top" :src="'/upload/' + pending.task.img">
                                    </div>
                                    <div class="back mx-4" :class="{'card-hidden': !pending_isFlipped[index]}">
                                        <div class="row my-2">
                                            @{{ pending.task.description }}
                                        </div>
                                        <div class="row my-2">
                                            Sender:  @{{ pending.started_by.user_name }}
                                        </div>
                                        <div class="row my-2">
                                            Reward:  @{{ pending.task.award_id }}
                                        </div>
                                        <div class="row button-container my-2 mr-4">
                                            <div class="col-md-12">
                                                <input  class="btn btn-primary  float-right" type="button"
                                                        value="Accept Challenge" @click.stop @click="acceptPending(pending.id)"/>
                                            </div>
                                        </div>
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
                                   value="View More" @click="loadPendingChallenges()" v-if="pending_id!=1 && more_pending"/>
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
                    <div class="card my-challenge my-2" @click="current_isFlipped.splice(index,1,!current_isFlipped[index])">
                        <div class="row">
                            <div class="col cardBox">
                                <div class="my-challenge-info card" :class="{ 'flip-challenge': current_isFlipped[index] }">
                                    <div class="front" :class="{'card-hidden': current_isFlipped[index]}">
                                        <img class="card-img-top" :src="'/upload/' + current.challenge.task.img">
                                    </div>
                                    <div class="back mx-4" :class="{'card-hidden': !current_isFlipped[index]}">
                                        <div class="row my-2">
                                            @{{ current.challenge.task.description }}
                                        </div>
                                        <div class="row my-2">
                                            Sender:  @{{ current.challenge.started_by.user_name }}
                                        </div>
                                        <div class="row my-2">
                                            Start Time:  @{{ current.start_time }}
                                        </div>
                                        <div class="row my-2">
                                            Due Time:  @{{ current.challenge.due_time }}
                                        </div>
                                        <div class="row my-2">
                                            Reward:  @{{ current.challenge.task.award_id }}
                                        </div>
                                        <div class="row my-2">
                                            <label for="current-progress">Current Progress: </label>
                                            <input id="current-progress" type="number" :value=current.current_value :min=current.current_value :max=current.challenge.task.total_value step="0.5"/>/@{{current.challenge.task.total_value}}
                                        </div>
                                        <div class="row my-2">
                                            Percent Complete:
                                            <div class="progress col-md-12 mx-8">
                                                <div class="progress-bar" role="progressbar" :style="{width: current.percent + '%'}" :aria-valuenow=current.percent aria-valuemin="0" aria-valuemax="100">@{{ current.percent }}%</div>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            Ranking: @{{current.ranking}}
                                        </div>
                                        <div class="row my-2">
                                            Finished:
                                            <div class="rounded-circle challenge-finished-indicator-accepted mx-2">

                                            </div>
                                        </div>
                                        <div class="row button-container my-2 mr-4">
                                            <div class="col-md-12">
                                                <input  class="btn btn-primary  float-right" type="button"
                                                        value="Submit Progress" @click.stop/>
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
                                   value="View More" @click="loadCurrentChallenges()" v-if="current_id!=1 && more_current"/>
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
                    <div class="card my-challenge my-2" @click="completed_isFlipped.splice(index,1,!completed_isFlipped[index])">
                        <div class="row">
                            <div class="col cardBox">
                                <div class="my-challenge-info card" :class="{ 'flip-challenge': completed_isFlipped[index] }">
                                    <div class="front" :class="{'card-hidden': completed_isFlipped[index]}">
                                        <img class="card-img-top" :src="'/upload/' + completed.challenge.task.img">
                                    </div>
                                    <div class="back mx-4" :class="{'card-hidden': !completed_isFlipped[index]}">>
                                        <div class="row my-2">
                                            @{{ completed.challenge.task.description }}
                                        </div>
                                        <div class="row my-2">
                                            Sender:  @{{ completed.challenge.started_by.user_name }}
                                        </div>
                                        <div class="row my-2">
                                            Start Time:  @{{ completed.start_time }}
                                        </div>
                                        <div class="row my-2">
                                            Due Time:  @{{ completed.challenge.due_time }}
                                        </div>
                                        <div class="row my-2">
                                            Reward:  @{{ completed.challenge.task.award_id }}
                                        </div>
                                        <div class="row my-2">
                                            Current Progress: @{{ completed.current_value }}/@{{completed.challenge.task.total_value}}
                                        </div>
                                        <div class="row my-2">
                                            Percent Complete:
                                            <div class="progress col-md-12 mx-8">
                                                <div class="progress-bar" role="progressbar" :style="{width: completed.percent + '%'}" :aria-valuenow=completed.percent aria-valuemin="0" aria-valuemax="100">@{{ completed.percent }}%</div>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            Ranking: @{{completed.ranking}}
                                        </div>
                                        <div class="row my-2">
                                            Finished: @{{ completed.finish_time }}
                                            <div v-if="completed.finish_flag == 1" class="rounded-circle challenge-finished-indicator-success mx-2">

                                            </div>
                                            <div v-else class="rounded-circle challenge-finished-indicator-fail mx-2">

                                            </div>

                                        </div>
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
                                   value="View More" @click="loadCompletedChallenges()" v-if="completed_id!=1 && more_completed"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

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
                        var currentLength =this.pending_challenges.length;
                        this.pending_challenges=this.pending_challenges.concat( response.data);
                        var numberAdded = this.pending_challenges.length-currentLength;
                        if(numberAdded == 0)
                        {
                            this.more_pending = false;
                        }
                        else
                        {
                            this.pending_id = response.data[numberAdded - 1].id;

                            for (var i = 0;i<numberAdded;i++)
                            {
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
                        else
                        {
                            this.current_id = response.data[numberAdded - 1].id;
                            for (var i = 0;i<numberAdded;i++)
                            {
                                this.current_isFlipped.push(false);
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
                        var currentLength =this.completed_challenges.length;
                        this.completed_challenges=this.completed_challenges.concat( response.data);
                        console.log(response.data)
                        var numberAdded = this.completed_challenges.length-currentLength;
                        if(numberAdded == 0)
                        {
                            this.more_completed = false;
                        }
                        else
                        {
                            this.completed_id = response.data[numberAdded - 1].id;
                            console.log(this.completed_id)
                            for (var i = 0;i<numberAdded;i++)
                            {
                                this.completed_isFlipped.push(false);
                            }
                        }



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

