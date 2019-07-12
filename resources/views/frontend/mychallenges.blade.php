@extends('frontend/layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
             <div class="row my-challenges">
            <h1>My Challenges</h1>
             </div>
            <div class="row pending-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Pending Challenges
                </h2>
                <div class="row pending-container w-100 mx-2 my-2">
                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                                <div class="row button-container">
                                    <input  class="btn btn-primary" type="button" data-toggle="collapse"
                                            aria-expanded="false"
                                            aria-controls="my-challenge-1" value="View Challenge" data-target="#my-challenge-1"/>
                                </div>

                            </div>
                            <div class="row">
                            <div class="col">
                            <div class="challenge-info collapse"  id="my-challenge-1">
                                <div class="row challenge-desc" >
                                    <p class="mx-5 card-text challenge-desc-content">
                                        This is a challenge. Challenges encourage students to complete tasks on time
                                        by motivating them with points one a task is completed. Parents can then use
                                        these points to give their children rewards. The goal of this is to make learning fun.
                                    </p>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row accepted-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Accepted Challenges
                </h2>
                <div class="row accepted-container w-100 mx-2 my-2">
                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row created-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Created Challenges
                </h2>
                <div class="row created-container w-100 mx-2 my-2">
                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row completed-challenges my-challenge-headings">
                <h2 class="mx-5">
                    Completed Challenges
                </h2>
                <div class="row completed-container w-100 mx-2 my-2">
                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="card w-100">
                            <div class="card-header">
                                <h1 class="card-title">This is a challenge</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
