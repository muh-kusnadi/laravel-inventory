@extends('layouts.app-admin')

@section('breadcrumbs')
<h1>
    Admin Profile
    <small>Edit</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Admin Profile</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">

            <form action="{{route('admin.update')}}" method="POST">
                @csrf
                <input type="hidden" name="admin_id" value="{{$user->id}}">

                <div class="box-body">

                    <div class="form-group">

                        <div class="form-group @error('name') has-error @enderror">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            @error('name')
                                <span class="help-block">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label>E-Mail</label>
                            <input type="text" class="form-control" name="email" value="{{$user->email}}">
                            @error('email')
                                <span class="help-block">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('password') has-error @enderror">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <span class="help-block">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Re-enter New Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>

                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                    <a href="{{route('admin.home')}}" class="btn btn-default">Back</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
