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
                            <div class="public-challenge-info card" :class="{ 'flip-challenge': isFlipped[index] }">
                            <div class="front">
                            <img class="card-img-top" :src="'/upload/' + challenge.task.img">
                            </div>
                            <div class="back col-md-12 h-100 my-auto">
                                <div class="row my-2">
                                    @{{ challenge.task.description }}
                                </div>
                                <div class="row my-2">
                                   Reward:  @{{ challenge.task.award_id }}
                                </div>
                                <div class="row button-container my-2 mr-4">
                                    <div class="col-md-12">
                                        <input  class="btn btn-primary  float-right" type="button"
                                                value="Accept Challenge" @click.stop/>
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
            <div class="col-md-12">
                <div class="row button-container my-2 mr-4">
                    <div class="col-md-12">
                        <input id="view-more-button" class="btn btn-primary float-right" type="button"
                               value="View More" @click="loadChallenges()" v-if="id!=1"/>
                    </div>
                </div>
            </div>
        </div>

     </div>
    </div>
    <script>

        var public_challenges = new Vue({
            el: '#public-challenge-container',
            data: {

                    challenges: [],
                    id: '',
                    isFlipped: []
                },
            methods: {
                loadChallenges() {
                    let $this = this;
                    console.log('here')
                    axios
                        .post('/getpublicchallenges', {
                            id: this.id,
                            "_token": "{{ csrf_token() }}",
                        })
                        .then((response) => {
                            var currentLength =this.challenges.length;
                            /*console.log(response.data[2].id)
                            console.log(this.challenges)*/
                            this.challenges=this.challenges.concat( response.data);
                            var numberAdded = this.challenges.length-currentLength;
                            /*console.log(this.challenges)*/
                            this.id = response.data[numberAdded - 1].id;
                            console.log(this.id)
                            for (var i = 0;i<numberAdded;i++)
                            {
                                this.isFlipped.push(false);
                            }

                            /*console.log(this.id)*/
                            console.log(this.isFlipped)
                            console.log(this.isFlipped.includes(0))

                        })
                    }


            },
            mounted() {
                this.loadChallenges()

            }
        })
    </script>
@endsection
