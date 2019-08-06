@extends('frontend/layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <div class="container-fluid">
        <div class="row">
            <h1>Sent Challenges</h1>
        </div>
        <div id="sent_challenges_container" class="row">
            <div class="col-md-12 pending-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Not Yet Accepted Challenges
                </h2>
                <div id="pending-challenge-container" class="row pending-challenge-row">
                    <div class="col-md-4" v-for="(unaccepted,index) in unaccepted_challenges" :key="index">
                        <div class="card my-challenge my-2" @click="unaccepted_isFlipped.splice(index,1,!unaccepted_isFlipped[index])">
                            <div class="row">
                                <div class="col cardBox">
                                    <div class="my-challenge-info card" :class="{ 'flip-challenge': unaccepted_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden':unaccepted_isFlipped[index]}">
                                            <img class="card-img-top" :src="'/upload/' + unaccepted.task.img">
                                        </div>
                                        <div class="back mx-4" :class="{'card-hidden': !unaccepted_isFlipped[index]}">
                                            <div class="row my-2">
                                                @{{ unaccepted.task.description }}
                                            </div>
                                            <div class="row my-2" v-if="unaccepted.user_id!= null">
                                                Sent to user @{{ unaccepted.user.user_name}}
                                            </div>
                                            <div class="row my-2" v-else-if="unaccepted.group_id!= null">
                                                Sent to group: @{{ unaccepted.group.name}}
                                            </div>
                                            <div class="row my-2" v-else>
                                                Sent to public
                                            </div>
                                            <div class="row my-2">
                                                Reward:  @{{ unaccepted.award.award_name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <h1 class="card-title">
                                    @{{ unaccepted.task.name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 current-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Accepted Challenges
                </h2>
                <div id="current-challenge-container" class="row current-challenge-row">
                    <div class="col-md-4" v-for="(accepted,index) in accepted_challenges" :key="index">
                        <div class="card my-challenge my-2" @click="accepted_isFlipped.splice(index,1,!accepted_isFlipped[index])">
                            <div class="row">
                                <div class="col cardBox">
                                    <div class="my-challenge-info card" :class="{ 'flip-challenge': accepted_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden': accepted_isFlipped[index]}">
                                            <img class="card-img-top" :src="'/upload/' + accepted.challenge.task.img">
                                        </div>
                                        <div class="back mx-4" :class="{'card-hidden': !accepted_isFlipped[index]}">
                                            <div class="row my-2">
                                                @{{ accepted.challenge.task.description }}
                                            </div>
                                            <div class="row my-2">
                                                Start Time:  @{{ accepted.start_time }}
                                            </div>
                                            <div class="row my-2">
                                                Participant:  @{{ accepted.user.user_name }}
                                            </div>
                                            <div class="row my-2">
                                                Due Time:  @{{ accepted.challenge.due_time }}
                                            </div>
                                            <div class="row my-2">
                                                Reward:  @{{ accepted.challenge.award.award_name}}
                                            </div>
                                            <div class="row my-2">
                                                Current Progress: @{{ accepted.current_value }}/@{{accepted.challenge.task.total_value}}
                                            </div>
                                            <div class="row my-2">
                                                Percent Complete:
                                                <div class="progress col-md-12 mx-8">
                                                    <div class="progress-bar" role="progressbar" :style="{width: accepted.percent + '%'}" :aria-valuenow=accepted.percent aria-valuemin="0" aria-valuemax="100">@{{ accepted.percent }}%</div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                Ranking: @{{accepted.ranking}}
                                            </div>
                                            <div class="row my-2">
                                                Finished: @{{ accepted.finish_time }}
                                                <div v-if="accepted.finish_flag == 1" class="rounded-circle challenge-finished-indicator-success mx-2">

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
                                    @{{ accepted.challenge.task.name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 complete-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Approval Request Challenges
                </h2>
                <div id="complete-challenge-container" class="row complete-challenge-row">
                    <div class="col-md-4" v-for="(approval,index) in approval_challenges" :key="index">
                        <div class="card my-challenge my-2" @click="approval_isFlipped.splice(index,1,!approval_isFlipped[index])">
                            <div class="row">
                                <div class="col cardBox">
                                    <div class="my-challenge-info card" :class="{ 'flip-challenge': approval_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden': approval_isFlipped[index]}">
                                            <img class="card-img-top" :src="'/upload/' + approval.challenge_progress.challenge.task.img">
                                        </div>
                                        <div class="back mx-4" :class="{'card-hidden': !approval_isFlipped[index]}">>
                                            <div class="row my-2">
                                                @{{ approval.challenge_progress.challenge.task.description }}
                                            </div>
                                            <div class="row my-2">
                                                Request By: @{{ approval.requested_by.user_name }}
                                            </div>
                                            <div class="row my-2">
                                                Request Created:  @{{ approval.create_time }}
                                            </div>
                                            <div class="row my-2">
                                                Start Time:  @{{ approval.challenge_progress.start_time }}
                                            </div>
                                            <div class="row my-2">
                                                Due Time:  @{{ approval.challenge_progress.challenge.due_time }}
                                            </div>
                                            <div class="row my-2">
                                                Reward:  @{{ approval.challenge_progress.challenge.award.award_name }}
                                            </div>
                                            <div class="row my-2">
                                                Current Progress: @{{ approval.challenge_progress.current_value }}/@{{approval.challenge_progress.challenge.task.total_value}}
                                            </div>
                                            <div class="row my-2">
                                                Percent Complete:
                                                <div class="progress col-md-12 mx-8">
                                                    <div class="progress-bar" role="progressbar" :style="{width: approval.challenge_progress.percent + '%'}" :aria-valuenow=approval.challenge_progress.percent aria-valuemin="0" aria-valuemax="100">@{{ approval.challenge_progress.percent }}%</div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                Ranking: @{{approval.challenge_progress.ranking}}
                                            </div>
                                            <div class="row my-2">
                                                Added Value: @{{ approval.add_value }}
                                            </div>
                                            <div class="row my-2">
                                                <div class="col mx-2">
                                                    <input  class="btn btn-primary  float-left" type="button"
                                                            value="Approve Progress" @click.stop @click="verifyProgress(approval.id,1)"/>
                                                </div>
                                                <div class="col mx-2">
                                                    <input  class="btn btn-primary  float-right" type="button"
                                                            value="Deny Progress" @click.stop @click="verifyProgress(approval.id,2)"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <h1 class="card-title">
                                    @{{ approval.challenge_progress.challenge.task.name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        var sent_challenges = new Vue({
            el: '#sent_challenges_container',
            data: {
                unaccepted_challenges: [],
                unaccepted_isFlipped: [],

                accepted_challenges: [],
                accepted_isFlipped: [],

                approval_challenges: [],
                approval_isFlipped: []



            },
            methods: {
                loadUnacceptedChallenges() {
                    let $this = this;
                    axios
                        .get('/createdchallenges/unaccepted/list')
                        .then((response) => {
                            this.unaccepted_challenges = response.data;
                            for (var i = 0;i<this.unaccepted_challenges.length;i++)
                            {
                                this.unaccepted_isFlipped.push(false);
                            }

                        })

                },


                loadAcceptedChallenges() {
                    let $this = this;
                    axios
                        .get('/createdchallenges/accepted/list')
                        .then((response) => {
                            this.accepted_challenges = response.data;
                            for (var i = 0;i<this.accepted_challenges.length;i++)
                            {
                                this.unaccepted_isFlipped.push(false);
                            }

                        })
                },
                loadApprovalRequests() {
                    let $this = this;
                    axios
                        .get('/approvalrequest/list')
                        .then((response) => {
                            this.approval_challenges= response.data;
                            for (var i = 0;i<this.approval_challenges.length;i++)
                            {
                                this.approval_isFlipped.push(false);
                            }



                        })
                },
                verifyProgress(requestId, decision)
                {
                    let $this = this;
                    axios
                        .post('/approvalrequest/update', {
                            id: requestId,
                            senderDecision: decision,
                            "_token": "{{ csrf_token() }}"
                        })
                        .then((response) => {
                            window.location.replace(response.data);
                        })
                }


            },

            mounted() {
                this.loadUnacceptedChallenges()
                this.loadAcceptedChallenges()
                this.loadApprovalRequests()

            }
        })

    </script>

@endsection


