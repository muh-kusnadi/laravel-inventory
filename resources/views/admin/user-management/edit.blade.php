@extends('layouts.app-admin')

@section('breadcrumbs')
<h1>
    User Management
    <small>Edit</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> User Management</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">

            <form action="{{route('user.management.update')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">

                <div class="box-body">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly>
                    </div>

                    <div class="form-group">
                        <label>E-Mail</label>
                        <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly>
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

                    <div class="form-grup">
                        <select name="status" class="form-control">
                            <option value="0" <?= $user->status  == 0 ? ' selected="selected"' : '';?>>Active</option>
                            <option value="1" <?= $user->status  == 1 ? ' selected="selected"' : '';?>>Not Active</option>
                        </select>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                    <a href="{{route('user.management.index')}}" class="btn btn-default">Back</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
