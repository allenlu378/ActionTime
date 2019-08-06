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
                                    <div class="my-challenge-info card mt-0" :class="{ 'flip-challenge': unaccepted_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden':unaccepted_isFlipped[index]}"
                                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+unaccepted.task.img+')'}">
                                            <img class="card-img-top p-0" >
                                        </div>
                                        <div class="back" :class="{'card-hidden': !unaccepted_isFlipped[index]}">
                                            <h5 class="w-100 back-title-description">Description</h5>
                                            <div class="description-un">
                                                @{{ unaccepted.task.description }}
                                            </div>
                                            <div class="row attr-row mx-0">

                                                <div class="col px-0" v-if="unaccepted.user_id!= null">
                                                    <h5 class="back-title sender-pend">Sent to user:</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+unaccepted.user.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ unaccepted.user.user_name }} </p>
                                                    </div>

                                                </div>
                                                <div class="col px-0" v-if="unaccepted.group_id!= null">
                                                    <h5 class="back-title sender-pend">Sent to Group:</h5>
                                                    <div class="row mt-2">
                                                        <p class="reward-txt"> @{{ unaccepted.group.name }} </p>
                                                    </div>

                                                </div>
                                                <div class="col px-0" v-else>
                                                    <h5 class="back-title sender-pend">Sent to:</h5>
                                                    <div class="row mt-2">
                                                        <p class="reward-txt">Public</p>
                                                    </div>

                                                </div>
                                                <div class='vert-line'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title reward-pend">Reward</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+unaccepted.award.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ unaccepted.award.award_name }} </p>
                                                    </div>
                                                </div>
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
                                    <div class="my-challenge-info card mt-0" :class="{ 'flip-challenge': accepted_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden': accepted_isFlipped[index]}"
                                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+accepted.challenge.task.img+')'}">
                                            <img class="card-img-top p-0">
                                        </div>
                                        <div class="back" :class="{'card-hidden': !accepted_isFlipped[index]}">
                                            <h5 class="w-100 back-title-description current-desc">Description</h5>
                                            <div class="description-current">
                                                @{{ accepted.challenge.task.description }}
                                            </div>
                                            <div class="row attr-row mx-0">
                                                <div class="col px-0">
                                                    <h5 class="back-title sender-cur">Accepted by:</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+accepted.user.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{
                                                            accepted.user.user_name }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title reward-cur">Reward</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+accepted.challenge.award.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ accepted.challenge.award.award_name
                                                            }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 times-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title start-cur">Start Date</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ accepted.start_time }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-date'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title due-cur">Due Date</h5>
                                                    <div class="row">

                                                        <p class="reward-txt"> @{{ accepted.challenge.due_time }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 finish-margin">
                                                <div class="col px-0">
                                                    <h5 class="mb-0 back-title start-cur">Date Completed</h5>
                                                    <div class="row">
                                                        <p v-if = "accepted.finish_time != null" class="reward-txt"> @{{ accepted.finish_time }} </p>
                                                        <p v-else class="reward-txt"> Not yet Completed </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-date'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title due-cur">Progress</h5>
                                                    <div class="row">
                                                        <p class="text-white">@{{ accepted.current_value }}/@{{accepted.challenge.task.total_value}}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-auto">
                                                <h5 class="back-title-description w-100 mb-2 cur-cur">Current
                                                    Progress</h5>
                                                <div class="progress col-md-8 mb-1 px-0">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="color: black;"
                                                         :style="{width: accepted.percent + '%'}"
                                                         :aria-valuenow=accepted.percent aria-valuemin="0"
                                                         aria-valuemax="100">@{{ accepted.percent }}%
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row attr-row mx-0 ranking-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title rank-cur">Ranking</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ accepted.ranking }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-ranking'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title status-cur">Status</h5>
                                                    <div class="row">
                                                        <div v-if="accepted.finish_flag == 1" class="rounded-circle challenge-finished-indicator-success mx-2 mt-1">
                                                        </div>
                                                        <div v-else class="rounded-circle challenge-finished-indicator-fail mx-2">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

{{--                                            <div class="row attr-row mx-0 ranking-margin">--}}
{{--                                                <div class="col px-0">--}}
{{--                                                    <h5 class="back-title update-cur">Update Progress</h5>--}}
{{--                                                    <div class="row mt-2" style="color: white">--}}
{{--                                                        <input id="current-progress" type="number"--}}
{{--                                                               class="mr-1"--}}
{{--                                                               :value=current.current_value--}}
{{--                                                               :min=current.current_value--}}
{{--                                                               :max=current.challenge.task.total_value step="0.5" v-model="current_newValue[index]" @click.stop/>--}}
{{--                                                        <p style="color: white">--}}
{{--                                                            /@{{current.challenge.task.total_value}}</p>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <div class='vert-line-progress'>--}}
{{--                                                </div>--}}
{{--                                                <div class="col px-0">--}}
{{--                                                    <h5 class="back-title submit-cur">Submit Progress</h5>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <input class="btn btn-success  float-right mb-1" type="button"--}}
{{--                                                               value="Submit Progress" @click.stop @click="submitChallengeProgress(current.id,current.current_value,index)"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}



{{--                                            <div class="row my-2">--}}
{{--                                                @{{ accepted.challenge.task.description }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Start Time:  @{{ accepted.start_time }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Participant:  @{{ accepted.user.user_name }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Due Time:  @{{ accepted.challenge.due_time }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Reward:  @{{ accepted.challenge.award.award_name}}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Current Progress: @{{ accepted.current_value }}/@{{accepted.challenge.task.total_value}}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Percent Complete:--}}
{{--                                                <div class="progress col-md-12 mx-8">--}}
{{--                                                    <div class="progress-bar" role="progressbar" :style="{width: accepted.percent + '%'}" :aria-valuenow=accepted.percent aria-valuemin="0" aria-valuemax="100">@{{ accepted.percent }}%</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Ranking: @{{accepted.ranking}}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Finished: @{{ accepted.finish_time }}--}}
{{--                                                <div v-if="accepted.finish_flag == 1" class="rounded-circle challenge-finished-indicator-success mx-2">--}}

{{--                                                </div>--}}
{{--                                                <div v-else class="rounded-circle challenge-finished-indicator-fail mx-2">--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
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
                                    <div class="my-challenge-info card mt-0" :class="{ 'flip-challenge': approval_isFlipped[index] }">
                                        <div class="front" :class="{'card-hidden': approval_isFlipped[index]}"
                                             v-bind:style="{ backgroundImage: 'url(../../../upload/'+approval.challenge_progress.challenge.task.img+')'}">
                                            <img class="card-img-top p-0">
                                        </div>
                                        <div class="back" :class="{'card-hidden': !approval_isFlipped[index]}">
                                            <h5 class="w-100 back-title-description current-desc">Description</h5>
                                            <div class="description-current">
                                                @{{ approval.challenge_progress.challenge.task.description }}
                                            </div>
                                            <div class="row attr-row mx-0">
                                                <div class="col px-0">
                                                    <h5 class="back-title sender-cur">Requested by</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+approval.requested_by.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{
                                                            approval.requested_by.user_name }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title reward-cur">Reward</h5>
                                                    <div class="row">
                                                        <div class="nav-prof-container-my shadow-sm mr-2">
                                                            <input type="image" id="nav-prof" class="nav-prof-pic"
                                                                   v-bind:src="'../../../upload/'+approval.challenge_progress.challenge.award.img">
                                                        </div>
                                                        <p class="reward-txt"> @{{ approval.challenge_progress.challenge.award.award_name
                                                            }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 times-margin">
                                                <div class="col px-0">
                                                    <h5 class="mb-0 back-title start-cur">Date Requested</h5>
                                                    <div class="row">
                                                        <p class="reward-txt"> @{{ approval.create_time }} </p>
                                                    </div>

                                                </div>
                                                <div class='vert-line-date'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title due-cur">Due Date</h5>
                                                    <div class="row">

                                                        <p class="reward-txt"> @{{ approval.challenge_progress.challenge.due_time }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row attr-row mx-0 finish-margin">
                                                <div class="col px-0">
                                                    <h5 class="back-title due-cur">Current Progress</h5>
                                                    <div class="row">
                                                        <p class="text-white">@{{ approval.challenge_progress.current_value }}/@{{approval.challenge_progress.challenge.task.total_value}}</p>

                                                    </div>
                                                </div>
                                                <div class='vert-line-date'>
                                                </div>
                                                <div class="col px-0">
                                                    <h5 class="back-title due-cur">Request</h5>
                                                    <div class="row">
                                                        <p class="text-white">@{{ approval.add_value }}/@{{approval.challenge_progress.challenge.task.total_value}}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-auto">
                                                <h5 class="back-title-description w-100 mb-2 cur-cur">Percent
                                                    Progress</h5>
                                                <div class="progress col-md-8 mb-1 px-0">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="color: black;"
                                                         :style="{width: approval.challenge_progress.percent + '%'}"
                                                         :aria-valuenow=approval.challenge_progress.percent aria-valuemin="0"
                                                         aria-valuemax="100">@{{ approval.challenge_progress.percent }}%
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row attr-row mx-0 mt-2">
                                                <div class="col-sm-6 px-0 h-100">
                                                    <input  class="btn btn-success w-50" type="button"
                                                            value="Approve" @click.stop @click="verifyProgress(approval.id,1)"/>
                                                </div>
                                                <div class="col-sm-6 px-0">
                                                    <input  class="btn btn-danger w-50" type="button"
                                                            value="Deny" @click.stop @click="verifyProgress(approval.id,2)"/>
                                                </div>
                                            </div>


{{--                                            <div class="row attr-row mx-0 ranking-margin">--}}
{{--                                                <div class="col px-0">--}}
{{--                                                    <h5 class="back-title rank-cur">Ranking</h5>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <p class="reward-txt"> @{{ accepted.ranking }} </p>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <div class='vert-line-ranking'>--}}
{{--                                                </div>--}}
{{--                                                <div class="col px-0">--}}
{{--                                                    <h5 class="back-title status-cur">Status</h5>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div v-if="accepted.finish_flag == 1" class="rounded-circle challenge-finished-indicator-success mx-2 mt-1">--}}
{{--                                                        </div>--}}
{{--                                                        <p class="text-white">Complete!</p>--}}
{{--                                                        <div v-else class="rounded-circle challenge-finished-indicator-fail mx-2">--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}




{{--                                            <div class="row my-2">--}}
{{--                                                @{{ approval.challenge_progress.challenge.task.description }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Request By: @{{ approval.requested_by.user_name }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Request Created:  @{{ approval.create_time }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Start Time:  @{{ approval.challenge_progress.start_time }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Due Time:  @{{ approval.challenge_progress.challenge.due_time }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Reward:  @{{ approval.challenge_progress.challenge.award.award_name }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Current Progress: @{{ approval.challenge_progress.current_value }}/@{{approval.challenge_progress.challenge.task.total_value}}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Percent Complete:--}}
{{--                                                <div class="progress col-md-12 mx-8">--}}
{{--                                                    <div class="progress-bar" role="progressbar" :style="{width: approval.challenge_progress.percent + '%'}" :aria-valuenow=approval.challenge_progress.percent aria-valuemin="0" aria-valuemax="100">@{{ approval.challenge_progress.percent }}%</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Ranking: @{{approval.challenge_progress.ranking}}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                Added Value: @{{ approval.add_value }}--}}
{{--                                            </div>--}}
{{--                                            <div class="row my-2">--}}
{{--                                                <div class="col mx-2">--}}
{{--                                                    <input  class="btn btn-primary  float-left" type="button"--}}
{{--                                                            value="Approve Progress" @click.stop @click="verifyProgress(approval.id,1)"/>--}}
{{--                                                </div>--}}
{{--                                                <div class="col mx-2">--}}
{{--                                                    <input  class="btn btn-primary  float-right" type="button"--}}
{{--                                                            value="Deny Progress" @click.stop @click="verifyProgress(approval.id,2)"/>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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


