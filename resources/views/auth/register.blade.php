@extends('layouts.auth')

@section('content')
<div class="login-logo">
    <a href="{{route('register')}}">Sign Up!</a>
</div>

<!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg">Create new account member</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group has-feedback @error('name') has-error @enderror">

            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>

            @error('name')
            <span style="color: red;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group has-feedback @error('email') has-error @enderror">

            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            @error('email')
            <span style="color: red;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group has-feedback @error('password') has-error @enderror">

            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            @error('password')
            <span style="color: red;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group has-feedback">

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        </div>

        <div class="row">

            <div class="col-xs-8">
                <div class="checkbox icheck">
                <a href="{{route('login')}}" class="btn btn-default">Back</a>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
@endsection
