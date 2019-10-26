<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use Auth;
use DB;
use DataTables;

class UserInventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function json()
    {
        $inventory = DB::table('inventories')
                        ->join('users', 'inventories.user_id', '=', 'users.id')
                        ->select('inventories.*', 'users.name as users_name');

        $dt = DataTables::of($inventory);

        $dt->addColumn('status', function($inventory){
            if($inventory->status == 0){
                return '<span class="label label-warning">Waiting</span>';
            } elseif($inventory->status == 1) {
                return '<span class="label label-success">Approve</span>';
            } else {
                return '<span class="label label-danger">Reject</span>';
            }
        });

        $dt->addColumn('action', function($inventory) {
			return '<button type="button" data-id="'.$inventory->id.'" data-toggle="modal" data-target="#modalStatus" class="btn btn-warning btn-xs">Update Status</button>';
        });

        $dt->rawColumns(['status','action']);

        return $dt->make(true);
    }

    public function index()
    {
        return view('admin.user-inventory.index');
    }

    public function get(Request $request)
    {
        $id             = $request->id;
        $inventory      = Inventory::find($id);

        echo $inventory;
    }

    public function update(Request $request)
    {
        $id             = $request->id_inventory;
        $user_id        = $request->user_id;
        $status         = $request->status;

        $inventory      = Inventory::find($id);
        $inventory->status  = $status;
        $inventory->save();

        return redirect()->route('user.iventory.index')->with('updated', 'Data User Inventory has been successfully updated!');
    }
}
