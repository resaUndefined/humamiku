@extends('layouts.auth.base')
@section('title', 'Reset Password')
@section('content')
    <h2>Reset your Password?</h2>
    <p class="p-forgot1">Masukkan password baru anda.</p>
    <div class="inputbox">
        @if(Session::has('status'))
            <ul class="help-block alert alert-warning">
                <li><strong>{{ Session::get('status') }}</strong></li>
            </ul>
        @endif
        @if ($errors->has('password'))
            <ul class="help-block alert alert-danger">
                <li><strong>{{ $errors->first('password') }}</strong></li>
            </ul>
        @endif
        @if ($errors->has('password_confirmation'))
            <ul class="help-block alert alert-danger">
                <li><strong>{{ $errors->first('password_confirmation') }}</strong></li>
            </ul>
        @endif
        @if(Session::has('message'))
            <ul class="help-block alert alert-warning">
                <li><strong>{{ Session::get('message') }}</strong></li>
            </ul>
        @endif
    </div>
    <form method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="inputbox{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" id="password" name="password" placeholder="password baru">
            <span><i class="fa fa-lock" aria-hidden="true"></i></span>
        </div>
        <div class="inputbox{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ketikkan ulang password">
            <span><i class="fa fa-lock" aria-hidden="true"></i></span>
        </div>              
        <input type="submit" value="Reset Password" class="custom-btn">
    </form>
@endsection
