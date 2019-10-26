@extends('layouts.app')

@section('breadcrumbs')
<h1>
    Inventory
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-archive"></i> Inventory</a></li>
</ol>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Inventory</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('deleted'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('updated'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('authorized'))
            <div class="alert alert-warning">
                {{ $message }}
            </div>
        @endif
        <a href="{{route('inventory.add')}}" class="btn btn-success">Add Inventory</a>
        <br><br>
        <table class="table table-striped table-bordered table-hover table-full-width" id="inventory-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Inventory Name</th>
                    <th>Inventory Owner</th>
                    <th>Status</th>
                    <th style="width: 15%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection

@push('script')
<script>
$(function(){
    var oTable = $('#inventory-table').DataTable({
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }],
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('inventory.json') }}'
        },
        columns: [
            { data: null, name: null, className: 'dt-center', searchable: false },
            { data: 'name', name: 'name' },
            { data: 'users_name', name: 'users.name' },
            { data: 'status', name: 'inventories.status', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ],
    });
})
</script>
@endpush
