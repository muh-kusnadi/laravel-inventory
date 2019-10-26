@extends('layouts.app-admin')

@section('breadcrumbs')
<h1>
    User Management
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> User Management</a></li>
</ol>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User Management</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>

    <div class="box-body">

        @if ($message = Session::get('updated'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <table class="table table-striped table-bordered table-hover table-full-width" id="users-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="width: 15%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
$(function(){
    var oTable = $('#users-table').DataTable({
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
            url: '{{ route('user.management.json') }}'
        },
        columns: [
            { data: null, name: null, className: 'dt-center', searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ],
    });
})
</script>
@endpush
