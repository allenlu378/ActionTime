@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="{{asset('/js/vue.min.js')}}"></script>
    <div class="container-fluid">
        <div class="row">
            <h1>Public Challenges</h1>
        </div>
        <div id="public-challenge-container" class="row public-challenge-row">
            <div class="col-md-4" v-for="challenge in computed.currentChallenges()">
                <div class="card public-challenge">
                    <div class="row">
                        <div class="col cardBox">
                            <div class="public-challenge-info card">
                            <div class="front">
                            <img class="card-img-top" :src=challenge.image>
                            </div>
                            <div class="back col-md-12 h-100 my-auto">
                                <div class="row my-2">
                                    @{{ challenge.description }}
                                </div>
                                <div class="row my-2">
                                   Reward:  @{{ challenge.reward }}
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
                            @{{ challenge.title }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <script>
           $(document).ready(function () {
               $(".public-challenge").each(function () {
                   $(this).on('click',function (e) {
                      if(!($(e.target).is('input')))
                      {
                          $(this).find('.public-challenge-info').toggleClass('flip-challenge');
                      }
                   })

               })
           })
        </script>
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
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'

            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use ' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            },
            {
                title: 'Challenge',
                image: 'frontend/images/person_speaking-512.png',
                description: 'This is a challenge. Challenges encourage students to complete tasks on time ' +
                    'by motivating them with points one a task is completed. Parents can then use           s' +
                    'these points to give their children rewards. The goal of this is to make learning fun.',
                reward: '10 points'
            }
        ]
        var public_challenges = new Vue({
            el: '#public-challenge-container',
            data: {
                currentChallenges: [],

                computed: {
                    currentChallenges() {
                        return challenge_list_db.slice(0, 10);
                    }
                }
            }
        })
    </script>
@endsection
