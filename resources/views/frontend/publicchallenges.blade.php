@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="{{asset('/js/vue.min.js')}}"></script>
    <div class="container-fluid">
        <div class="row">
            <h1>Public Challenges</h1>
        </div>
        <div id="public-challenge-container" class="row">
            <div class="col-md-4" v-for="challenge in computed.currentChallenges()">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            @{{ challenge.title }}
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="challenge-info">
                                <div class="row challenge-desc">
                                    <p class="card-text challenge-desc-content mx-5">
                                        @{{ challenge.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row button-container mr-4">
            <div class="col-md-12">
                <input id="view-more-button" class="btn btn-primary float-right" type="button"
                    value="View More" />
            </div>
     </div>
    </div>
    <script>
        var challenge_list_db = [
            {
                title: 'Challenge',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time' +
                    'by motivating them with points one a task is completed. Parents can then use' +
                    'these points to give their children rewards. The goal of this is to make learning fun.'
            },
            {
                title: 'Challenge',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time' +
                    'by motivating them with points one a task is completed. Parents can then use' +
                    'these points to give their children rewards. The goal of this is to make learning fun.'
            },
            {
                title: 'Challenge',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time' +
                    'by motivating them with points one a task is completed. Parents can then use' +
                    'these points to give their children rewards. The goal of this is to make learning fun.'
            },
            {
                title: 'Challenge',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time' +
                    'by motivating them with points one a task is completed. Parents can then use' +
                    'these points to give their children rewards. The goal of this is to make learning fun.'
            },
            {
                title: 'Challenge',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time' +
                    'by motivating them with points one a task is completed. Parents can then use' +
                    'these points to give their children rewards. The goal of this is to make learning fun.'
            },
            {
                title: 'Challenge',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time' +
                    'by motivating them with points one a task is completed. Parents can then use' +
                    'these points to give their children rewards. The goal of this is to make learning fun.'
            }
        ]
        var challenges = new Vue({
            el: '#public-challenge-container',
            data: {
                challenge_list: challenge_list_db,
                currentChallenges: [],

                currentChallenge: 3,


                computed: {
                    currentChallenges() {
                        return challenge_list_db.slice(0, challenge_list_db.currentChallenge);
                    }
                }
            }
        })
    </script>
@endsection
