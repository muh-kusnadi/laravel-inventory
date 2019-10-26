@extends('layouts.auth')

@section('content')
<div class="login-logo">
<a href="{{route('login')}}"><b>Users</b>Login</a>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="form-group has-feedback @error('email') has-error @enderror">

        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @error('email')
        <span style="color: red;" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group has-feedback @error('password') has-error @enderror">

        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @error('password')
        <span style="color: red;" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="row">

        <div class="col-xs-8">
            <div class="checkbox icheck">
            <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>
<!-- /.social-auth-links -->
<hr>
<div class="row">
    <div class="col-xs-8">
        <a href="{{route('register')}}" class="text-center">Create new account!</a>
    </div>
    <div class="col-xs-4">
        <a href="{{route('admin.login')}}" class="text-center">Admin Login</a>
    </div>
</div>



</div>
<!-- /.login-box-body -->
@endsection
