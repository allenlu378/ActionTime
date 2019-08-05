@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <h1>Approve Public Challenges</h1>
        </div>
        <div id="approve-public-challenge-container" class="row public-challenge-row">
            <div class="col-md-4" v-for="(challenge,index) in challenges" :key="index">
                <div class="card public-challenge" @click="isFlipped.splice(index,1,!isFlipped[index])">
                    <div class="row">
                        <div class="col cardBox">
                            <div class="public-challenge-info card" :class="{ 'flip-challenge': isFlipped[index] }">
                                <div class="front" :class="{'card-hidden': isFlipped[index]}">
                                    <img class="card-img-top" :src="'/upload/' + challenge.task.img">
                                </div>
                                <div class="back mx-4" :class="{'card-hidden': !isFlipped[index]}">
                                    <div class="row my-2">
                                        @{{ challenge.task.description }}
                                    </div>
                                    <div class="row my-2">
                                        Reward:  @{{ challenge.award.award_name }}
                                    </div>
                                    <div class="row my-2">
                                        <div class="col mx-2">
                                            <input  class="btn btn-primary  float-left" type="button"
                                                    value="Approve Challenge" @click.stop @click="verifyChallenge(challenge.id,1)"/>
                                        </div>
                                        <div class="col mx-2">
                                            <input  class="btn btn-primary  float-right" type="button"
                                                    value="Deny Challenge" @click.stop @click="verifyChallenge(challenge.id,-1)"/>
                                        </div>
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
        </div>

    </div>
    <script>
        var approve_public_challenges = new Vue({
            el: '#approve-public-challenge-container',
            data: {

                challenges: [],
                isFlipped: []
            },
            methods: {
                loadChallenges() {
                    let $this = this;
                    axios
                        .get('/admin/approve/publicchallenges/list')

                        .then((response) => {
                            this.challenges = response.data;
                            for (var i = 0; i < this.challenges.length; i++) {
                                this.isFlipped.push(false);
                            }



                        })


                },

                verifyChallenge(id, decision) {
                        axios
                            .post('/admin/approve/publicchallenges/update', {
                                id: id,
                                admin_decision: decision,
                                "_token": "{{ csrf_token() }}",
                            })
                            .then((response) => {
                                window.location.replace(response.data);
                            })
                    }
            },
            mounted() {
                this.loadChallenges()

            }


        })
    </script>
@endsection
