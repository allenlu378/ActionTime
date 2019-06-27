@extends('layouts.sign')
@section('content')
<h4>{{ __('Login') }}</h4>
    <h6 class="font-weight-light">Sign in to continue.</h6>
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="pt-3">
    @csrf
        <div class="form-group">
            <input id="Email"  placeholder="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                SIGN IN
            </button>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    Keep me signed in
                </label>
            </div>
            <a href="{{ route('password.request') }}" class="auth-link text-black">
                Forgot password?</a>
        </div>
        <div class="mb-2">
            <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
            </button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Don't have an account? <a href="{{route('register')}}" class="text-primary">Create</a>
        </div>
    </form>
@endsection