@extends('layouts.app-admin')

@section('breadcrumbs')
<h1>
    User Inventory
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-bank"></i> User Inventory</a></li>
</ol>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User Inventory</h3>

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
</div>

<!-- Modal Edit Role -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="{{route('user.iventory.update')}}" id="formStatus" method="POST">
        @csrf
        <input type="hidden" name="id_inventory">
        <input type="hidden" name="user_id">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Status Inventories</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="label-control">Inventory Name</label>
                    <input type="text" name="inventoryName" id="inventoryName" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="name" class="label-control">Inventory Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="" selected disabled>- Select Status -</option>
                        <option value="0">Waiting</option>
                        <option value="1">Approve</option>
                        <option value="2">Reject</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
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
            url: '{{ route('user.iventory.json') }}'
        },
        columns: [
            { data: null, name: null, className: 'dt-center', searchable: false },
            { data: 'name', name: 'name' },
            { data: 'users_name', name: 'users.name' },
            { data: 'status', name: 'inventories.status', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ],
    });

    //show data to update
    $('#modalStatus').on('show.bs.modal', function(e){
        var form = $('#formStatus');
        var id = $(e.relatedTarget).data('id');

        $.ajax({
            type: 'GET',
            url: '{{route("user.iventory.get")}}',
            data: {id:id},
            async: false,
            dataType: 'JSON',
            success: function(data){
                $('input[name="id_inventory"]').val(data.id);
                $('input[name="user_id"]').val(data.user_id);
                $('input[name="inventoryName"]').val(data.name);

                $('select[name="status"]').val(data.status).trigger('change');
            }
        });
    });
})
</script>
@endpush
