@extends('layouts.auth.base')
@section('title', 'Forgot Password')
@section('content')
<h2>Forgot your Password?</h2>
            <p class="p-forgot1">Masukkan email anda, untuk mendapatkan link untuk reset password anda!</p>
            <div class="inputbox">
                @if ($errors->has('email'))
                    <p class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
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
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
