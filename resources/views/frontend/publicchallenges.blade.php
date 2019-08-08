@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <h1>Public Challenges</h1>
        </div>
        <div id="public-challenge-container" class="row public-challenge-row">
            <div class="col-md-4" v-for="(challenge,index) in challenges" :key="index">
                <div class="card public-challenge" @click="isFlipped.splice(index,1,!isFlipped[index])">
                    <div class="row">
                        <div class="col cardBox">
                            <div class="public-challenge-info card mt-0"
                                 :class="{ 'flip-challenge': isFlipped[index] }">
                                <div class="front" :class="{'card-hidden': isFlipped[index]}"
                                     v-bind:style="{ backgroundImage: 'url(../../../upload/'+challenge.task.img+')'}">
                                    <img class="card-img-top p-0">
                                </div>
                                <div class="back" :class="{'card-hidden': !isFlipped[index]}">
                                    <h5 class="w-100 back-title-description">Description</h5>
                                    <div class="description">
                                        @{{ challenge.task.description }}
                                    </div>
                                    <div class="row attr-row mx-0 accept-margin">
                                        <div class="col px-0">
                                            <h5 class="back-title-description">Reward</h5>
                                            <div class="row px-0 mt-2">
                                                <div class="nav-prof-container shadow-sm mr-2">
                                                    <input type="image" id="nav-prof" class="nav-prof-pic"
                                                           v-bind:src="'../../../upload/'+challenge.award.img">
                                                </div>
                                                <p class="reward-txt"> @{{ challenge.award.award_name }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-0">
                                        <input class="btn btn-success" type="button" value="Accept Challenge"
                                               @click.stop @click="acceptChallenge(challenge.id)"/>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h1 class="card-title">
                            @{{ challenge.task.name }}
                        </h1>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row button-container my-2 mr-4">
                    <div class="col-md-12">
                        <input id="view-more-button" class="btn btn-primary float-right" type="button"
                               value="View More" @click="loadChallenges()" v-if="id!=1 && more_challenges"/>
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
        for (let i = 0; i < $('.description').length; i++) {
            var color = randomColor();
            var description = document.getElementsByClassName('back-title-description')[i*2];
            description.style.backgroundColor = color;
            var reward = document.getElementsByClassName('back-title-description')[i*2+1];
            reward.style.backgroundColor = color;

        }

    </script>
    <script>
        var auth_user = @json($user);
        console.log(auth_user);
        var public_challenges = new Vue({
            el: '#public-challenge-container',
            data: {

                challenges: [],
                id: '',
                isFlipped: [],
                more_challenges: true,

            },
            methods: {
                loadChallenges() {
                    let $this = this;
                    axios
                        .post('/publicchallenges/list', {
                            id: this.id,
                            "_token": "{{ csrf_token() }}",
                        })
                        .then((response) => {
                            var currentLength = this.challenges.length;
                            this.challenges = this.challenges.concat(response.data);
                            var numberAdded = this.challenges.length - currentLength;
                            if (numberAdded == 0) {
                                this.moreChallenges = false;
                            } else {
                                this.id = response.data[numberAdded - 1].id;
                                console.log(this.id)
                                for (var i = 0; i < numberAdded; i++) {
                                    this.isFlipped.push(false);
                                }

                                console.log(this.isFlipped)
                            }


                        })


                },

                acceptChallenge(challenge_id) {
                    if (auth_user != null) {
                        axios
                            .post('/publicchallenges/pending/create', {
                                id: challenge_id,
                                "_token": "{{ csrf_token() }}",
                            })
                            .then((response) => {
                                window.location.replace(response.data);
                            })
                    } else {
                        window.location.href = "/gologin";
                    }
                }

            },
            mounted() {
                this.loadChallenges()

            }
        })
    </script>

@endsection
