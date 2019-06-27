@extends('frontend/layout')
@section('content')
    <div class="content">
        <div class='left'><img class = 'block-icons' src = "{{asset('frontend/images/public_challenges.png')}}"><span class = 'block-title'>Public Challenges</span>
        </div>
        <div class='middle'><img class = 'block-icons' src = "{{asset('frontend/images/login.png')}}"><span class = 'block-title'>Login/Sign Up</span>
        </div>
        <div class='right'><img class = 'block-icons' src = "{{asset('frontend/images/info.png')}}"><span class = 'block-title'>Learn More</span>
        </div>
    </div>

@endsection
