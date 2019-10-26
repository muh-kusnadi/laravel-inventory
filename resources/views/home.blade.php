@extends('layouts.app')

@section('breadcrumbs')
<h1>
    Home
    <small>Users</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Users</li>
</ol>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard Users</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
        You are logged in as User!
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
