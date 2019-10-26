@extends('layouts.app')

@section('breadcrumbs')
<h1>
    Inventory
    <small>Edit</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-archive"></i> Inventory</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <form action="{{route('inventory.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id_inventory" value="{{$inventory->id}}">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Inventory</h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="form-group @error('name') has-error @enderror">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$inventory->name}}">
                        @error('name')
                            <span class="help-block">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                    <a href="{{route('inventory.index')}}" class="btn btn-default">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
