@extends('frontend/layout')
@section('content')
    <link href="{{asset('frontend/css/challenges.css')}}" type="text/css" rel="stylesheet" media="all">
    <div class="container-fluid">
        <div class="row">
            <h1>Public Challenges</h1>
        </div>
        <div id="public-challenge-container" class="row">

        </div>
    </div>
    <script>
        $(document).ready(function () {
            var challengeContainer = $("#public-challenge-container");
            var numberOfChallenges = 5;
            var currentChallenge = 1;
            var rowMaxWidth  = 3;
            var numberOfRows = Math.ceil(numberOfChallenges/rowMaxWidth);
            for(var rowIndex = 0; rowIndex < numberOfRows; rowIndex++)
            {
                var rowNum = rowIndex +1;
                challengeContainer.append('<div class=\"row public-challenge-row mx-2 my-2 \" id=\"row-' + rowNum + '\"></div>');
                for(var colIndex = 0; colIndex<rowMaxWidth; colIndex++)
                {
                    if(currentChallenge<= numberOfChallenges)
                    {
                        var row = $("#row-" + rowNum);
                        row.append('<div class="col-md-4">' +
                                        '<div class="card">'+
                                            '<div class="card-header">' +
                                                '<h1 class="card-title">Challenge ' +currentChallenge + ' of ' + numberOfChallenges +
                                                '</h1>'+
                                        '</div>'+
                                        '<div class="row">' +
                                            '<div class="col">' +
                                                '<div class="challenge-info">' +
                                                     '<div class="row challenge-desc">' +
                                                        '<p class="card-text challenge-desc-content mx-5">' +
                                                            'This is a challenge. Challenges encourage students to complete tasks on time' +
                                                            'by motivating them with points one a task is completed. Parents can then use' +
                                                            'these points to give their children rewards. The goal of this is to make learning fun.' +
                                                        '</p>' +
                                                    '</div>'+
                                                '</div>'+
                                            '</div>' +
                                        '</div>'+
                                '</div>');
                        currentChallenge++;
                    }
                }
            }

        })
    </script>
@endsection
