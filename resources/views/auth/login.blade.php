@extends('layouts.auth.base')
@section('title', 'Login')
@section('content')
    <img src="{{ URL::asset('front/img/humamiku.png') }}" class="user">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-danger">
            {{ session('warning') }}
        </div>
    @endif
    @if ($errors->has('email'))
        <p class="help-block alert alert-danger">
            <strong>{{ $errors->first('email') }}</strong>
        </p>
    @endif
    @if ($errors->has('password'))
        <p class="help-block alert alert-danger">
            <strong>{{ $errors->first('password') }}</strong>
        </p>
    @endif
    @if(Session::has('message'))
        <p class="help-block alert alert-warning">
            <strong>{{ Session::get('message') }}</strong>
        </p>
    @endif
    <form method="POST" action="{{ route('login.custom') }}">
        {{ csrf_field() }}
        <div class="inputbox{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
        </div>
        <div class="inputbox{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" required>
            <span><i class="fa fa-lock" aria-hidden="true"></i></span>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><p> Remember me</p>
            </label>
        </div>
        <p class="text-left"><a href="{{ route('password.request') }}">Forgot Password?</a></p>                   
        <input type="submit" value="Login" class="custom-btn">
    </form>
@endsection
