<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Admin;
use Auth;
use DB;
use Mail;
use DataTables;

class InventoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $dt->addColumn('action', function($inventory, $confirm = "'Are you sure?'") {
			return '<form method="post" action="'.route('inventory.destroy', $inventory->id).'" accept-charset="UTF-8">'.
			'<input name="_method" type="hidden" value="POST">'.
			'<input name="_token" type="hidden" value="'.csrf_token().'" >'.
			'<a href="'.route('inventory.edit', $inventory->id).'" class="btn btn-warning btn-xs">Edit</a>'. '&nbsp;' .
			'<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('.$confirm.')">Delete</button>'.
			'</form>';
        });

        $dt->rawColumns(['status','action']);

        return $dt->make(true);
    }

    public function index()
    {
        return view('users.inventory.index');
    }

    public function add()
    {
        return view('users.inventory.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'            => 'required|max:255',
        ];
        $niceNames = [
            'name'            => 'Name',
        ];

        $this->validate($request, $rules, [], $niceNames);

        Inventory::create([
            'name'      => $request->name,
            'user_id'   => Auth::user()->id
        ]);

        $inv = DB::table('inventories')
                ->join('users', 'inventories.user_id', '=', 'users.id')
                ->select('inventories.*', 'users.name as users_name', 'users.email as users_email')
                ->orderBy('inventories.created_at', 'desc')
                ->first();

        $admin = Admin::first();

        $to_name = $admin->name;

        $to_email = $admin->email;

        $url = url('/');

        $data = array('name' => $to_name, 'inv' => $inv);

        Mail::send('users.mail', $data, function($message) use ($to_name, $to_email, $inv, $url){
            $message->to($to_email, $to_name)
                    ->subject('Need Confirmation for Users Inventories Added!');
            $message->from($inv->users_email, 'Laravel Inventory System');
        });

        return redirect()->route('inventory.index')->with('success', 'Data Inventory has been successfully added!');
    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);

        if(Auth::user()->id == $inventory->user_id) {
            return view('users.inventory.edit', compact('inventory'));
        } else {
            return redirect()->route('inventory.index')->with('authorized', 'You cant edit other users data! ');
        }


    }

    public function update(Request $request)
    {
        $rules = [
            'name'            => 'required|max:255',
        ];
        $niceNames = [
            'name'            => 'Name',
        ];

        $this->validate($request, $rules, [], $niceNames);

        $id         = $request->id_inventory;
        $name       = $request->name;

        $inventory  = Inventory::find($id);

        $inventory->name = $name;

        $inventory->save();

        return redirect()->route('inventory.index')->with('updated', 'Data Inventory has been successfully updated!');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        if(Auth::user()->id == $inventory->user_id) {
            $inventory->delete();
            return redirect()->route('inventory.index')->with('deleted', 'Data Inventory has been deleted!');
        } else {
            return redirect()->route('inventory.index')->with('authorized', 'You cant delete other users data! ');
        }
    }
}
