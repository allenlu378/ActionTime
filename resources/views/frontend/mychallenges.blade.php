@extends('frontend/layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <div class="container-fluid">
        <div class="row">
            <h1>My Challenges</h1>
        </div>
        <div id="my_challenge_container" class="row mx-4">
            <div class="row pending-challenges my-challenge-headings">
            <h2 class="mx-5">
                Pending Challenges
            </h2>
            <div id="pending-challenge-container" class="row pending-challenge-row">
                <div class="col-md-4" v-for="pending in computed.currentPendingChallenges()">
                    <div class="card my-challenge my-2">
                        <div class="row">
                            <div class="col cardBox">
                                <div class="my-challenge-info card">
                                    <div class="front">
                                        <img class="card-img-top" :src=pending.image>
                                    </div>
                                    <div class="back mx-4">
                                        <div class="row my-2">
                                            @{{ pending.description }}
                                        </div>
                                        <div class="row my-2">
                                            Sender:  @{{ pending.sender }}
                                        </div>
                                        <div class="row my-2">
                                            Reward:  @{{ pending.reward }}
                                        </div>
                                        <div class="row button-container my-2 mr-4">
                                            <div class="col-md-12">
                                                <input  class="btn btn-primary  float-right" type="button"
                                                        value="Accept Challenge" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h1 class="card-title">
                                @{{ pending.title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row current-challenges my-challenge-headings">
            <h2 class="mx-5">
                Current Challenges
            </h2>
            <div id="current-challenge-container" class="row current-challenge-row">
                <div class="col-md-4" v-for="accepted in computed.currentAcceptedChallenges()">
                    <div class="card my-challenge my-2">
                        <div class="row">
                            <div class="col cardBox">
                                <div class="my-challenge-info card">
                                    <div class="front">
                                        <img class="card-img-top" :src=accepted.image>
                                    </div>
                                    <div class="back mx-4">
                                        <div class="row my-2">
                                            @{{ accepted.description }}
                                        </div>
                                        <div class="row my-2">
                                            Sender:  @{{ accepted.sender }}
                                        </div>
                                        <div class="row my-2">
                                            Start Time:  @{{ accepted.start_time }}
                                        </div>
                                        <div class="row my-2">
                                            Due Time:  @{{ accepted.due_time }}
                                        </div>
                                        <div class="row my-2">
                                            Reward:  @{{ accepted.reward }}
                                        </div>
                                        <div class="row my-2">
                                            <label for="current-progress">Current Progress: </label>
                                            <input id="current-progress" type="number" :value=accepted.current_progress :min=accepted.current_progress :max=accepted.total_value step="0.5"/>/@{{accepted.total_value}}
                                        </div>
                                        <div class="row my-2">
                                            Percent Complete:
                                            <div class="progress col-md-12 mx-8">
                                                <div class="progress-bar" role="progressbar" v-bind:style="{width: accepted.percent_complete + '%'}" :aria-valuenow=accepted.percent_complete aria-valuemin="0" aria-valuemax="100">@{{ accepted.percent_complete }}%</div>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            Ranking: @{{accepted.ranking}}
                                        </div>
                                        <div class="row my-2">
                                            Finished:
                                            <div class="rounded-circle challenge-finished-indicator-accepted mx-2">

                                            </div>
                                        </div>
                                        <div class="row button-container my-2 mr-4">
                                            <div class="col-md-12">
                                                <input  class="btn btn-primary  float-right" type="button"
                                                        value="Submit Progress" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h1 class="card-title">
                                @{{ accepted.title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row complete-challenges my-challenge-headings">
            <h2 class="mx-5">
                Completed Challenges
            </h2>
            <div id="complete-challenge-container" class="row complete-challenge-row">
                <div class="col-md-4" v-for="completed in computed.currentCompletedChallenges()">
                    <div class="card my-challenge my-2">
                        <div class="row">
                            <div class="col cardBox">
                                <div class="my-challenge-info card">
                                    <div class="front">
                                        <img class="card-img-top" :src=completed.image>
                                    </div>
                                    <div class="back mx-4">
                                        <div class="row my-2">
                                            @{{ completed.description }}
                                        </div>
                                        <div class="row my-2">
                                            Sender:  @{{ completed.sender }}
                                        </div>
                                        <div class="row my-2">
                                            Start Time:  @{{ completed.start_time }}
                                        </div>
                                        <div class="row my-2">
                                            Due Time:  @{{ completed.due_time }}
                                        </div>
                                        <div class="row my-2">
                                            Reward:  @{{ completed.reward }}
                                        </div>
                                        <div class="row my-2">
                                            Current Progress: @{{ completed.current_progress }}/@{{completed.total_value}}
                                        </div>
                                        <div class="row my-2">
                                            Percent Complete:
                                            <div class="progress col-md-12 mx-8">
                                                <div class="progress-bar" role="progressbar" v-bind:style="{width: completed.percent_complete + '%'}" :aria-valuenow=completed.percent_complete aria-valuemin="0" aria-valuemax="100">@{{ completed.percent_complete }}%</div>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            Ranking: @{{completed.ranking}}
                                        </div>
                                        <div class="row my-2">
                                            Finished: @{{ completed.finish_time }}
                                            <div v-if="completed.finished == 1" class="rounded-circle challenge-finished-indicator-success mx-2">

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
                                @{{ completed.title }}
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
            $(".my-challenge").each(function () {
                $(this).on('click',function (e) {
                    if(!($(e.target).is('input')))
                    {
                        $(this).find('.my-challenge-info').toggleClass('flip-challenge');
                    }
                })

            })
        })
    </script>


<script>
    var pending_challenge_list_db = [
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            reward: '10 points'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            reward: '10 points'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            reward: '10 points'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            reward: '10 points'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            reward: '10 points'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            reward: '10 points'

        }
     ];

    var current_challenge_list_db = [
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '20',
            total_value: '25',
            percent_complete: '80',
            ranking: '10th',
            finished: 0


        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '20',
            total_value: '25',
            percent_complete: '80',
            ranking: '10th',
            finished: 0


        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '20',
            total_value: '25',
            percent_complete: '80',
            ranking: '10th',
            finished: 0


        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '20',
            total_value: '25',
            percent_complete: '80',
            ranking: '10th',
            finished: 0


        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '20',
            total_value: '25',
            percent_complete: '80',
            ranking: '10th',
            finished: 0


        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '20',
            total_value: '25',
            percent_complete: '80',
            ranking: '10th',
            finished: 0


        }
    ];

    var completed_challenge_list_db = [
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '25',
            total_value: '25',
            percent_complete: '100',
            ranking: '10th',
            finished: 1,
            finish_time: '7/15/19 11:00 PM'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '25',
            total_value: '25',
            percent_complete: '100',
            ranking: '10th',
            finished: 1,
            finish_time: '7/15/19 11:00 PM'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '25',
            total_value: '25',
            percent_complete: '100',
            ranking: '10th',
            finished: 1,
            finish_time: '7/15/19 11:00 PM'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '25',
            total_value: '25',
            percent_complete: '100',
            ranking: '10th',
            finished: 1,
            finish_time: '7/15/19 11:00 PM'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '25',
            total_value: '25',
            percent_complete: '100',
            ranking: '10th',
            finished: 1,
            finish_time: '7/15/19 11:00 PM'

        },
        {
            title: 'Challenge',
            image: 'frontend/images/person_speaking-512.png',
            description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                'by motivating them with points one a task is completed. Parents can then use ' +
                'these points to give their children rewards. The goal of this is to make learning fun.',
            sender: 'user',
            start_time: '7/12/19 3:43 PM',
            due_time: '7/15/19 11:59 PM',
            reward: '10 points',
            current_progress: '25',
            total_value: '25',
            percent_complete: '100',
            ranking: '10th',
            finished: 1,
            finish_time: '7/15/19 11:00 PM'

        }
    ]
    var my_challenges = new Vue({
        el: '#my_challenge_container',
        data: {
            currentPendingChallenges: [],
            currentAcceptedChallenges: [],
            currentCompletedChallenges: [],

           computed: {
                currentPendingChallenges() {
                    return pending_challenge_list_db.slice(0, 3);
                },
                currentAcceptedChallenges() {
                    return current_challenge_list_db.slice(0, 3);
                },
                currentCompletedChallenges() {
                    return completed_challenge_list_db.slice(0, 3);
                }
            }
        }
    })

</script>

@endsection

