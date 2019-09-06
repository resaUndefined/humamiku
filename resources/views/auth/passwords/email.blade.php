@extends('layouts.auth.base')
@section('title', 'Forgot Password')
@section('content')
    <h2>Forgot your Password?</h2>
    <p class="p-forgot1">Masukkan email anda, untuk mendapatkan link untuk reset password anda!</p>
    <div class="inputbox">
    @if ($errors->has('email'))
        <ul class="help-block">
            <li><strong>{{ $errors->first('email') }}</strong></li>
        </ul>
    @endif
    @if(Session::has('status'))
        <ul class="help-block alert alert-warning">
            <li><strong>{{ Session::get('status') }}</strong></li>
        </ul>
    @endif
    @if(Session::has('message'))
        <ul class="help-block alert alert-warning">
            <li><strong>{{ Session::get('message') }}</strong></li>
        </ul>
    @endif
    </div>
    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="inputbox{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" id="email" name="email" placeholder="Email anda" value="{{ old('email') }}" required>
            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
        </div>              
        <input type="submit" value="Kirim link reset password" class="custom-btn">
    </form>
@endsection
