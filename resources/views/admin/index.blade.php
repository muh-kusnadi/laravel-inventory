@extends('layouts.app-admin')

@section('breadcrumbs')
<h1>
    Home
    <small>Admin</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Admin</li>
</ol>
@endsection

@section('content')
@if ($message = Session::get('updated'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Dashboard Admin</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
            <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        You are logged in as Admin!
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
