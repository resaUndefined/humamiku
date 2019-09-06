@extends('layouts.auth.base')
@section('title', 'Login')
@section('content')
    <img src="{{ URL::asset('front/img/humamiku.png') }}" class="user">
    @if(Session::has('status'))
        <ul class="help-block alert alert-warning">
            <li><strong>{{ Session::get('status') }}</strong></li>
        </ul>
    @endif
    @if ($errors->has('email'))
        <ul class="help-block alert alert-danger">
            <li><strong>{{ $errors->first('email') }}</strong></li>
        </ul>
    @endif
    @if ($errors->has('password'))
        <ul class="help-block alert alert-danger">
            <li><strong>{{ $errors->first('password') }}</strong></li>
        </ul>
    @endif
    @if(Session::has('message'))
        <ul class="help-block alert alert-warning">
            <li><strong>{{ Session::get('message') }}</strong></li>
        </ul>
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
