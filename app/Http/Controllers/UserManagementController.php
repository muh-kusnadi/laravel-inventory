<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use DataTables;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function json()
    {
        $user = User::all();

        $dt = DataTables::of($user);

        $dt->addColumn('status', function($user){
            if($user->status == 0){
                return '<span class="label label-success">Active</span>';
            } else {
                return '<span class="label label-danger">Not Active</span>';
            }
        });

        $dt->addColumn('action', function($user) {
			return '<a href="'.route('user.management.edit', $user->id).'" class="btn btn-warning btn-xs">Edit</a>';
        });

        $dt->rawColumns(['status','action']);

        return $dt->make(true);
    }

    public function index()
    {
        return view('admin.user-management.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user-management.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $rules = [
            'password'              => 'confirmed',
        ];
        $niceNames = [
            'password'              => 'Password',
        ];

        $this->validate($request, $rules, [], $niceNames);

        $id         = $request->user_id;
        $password   = $request->password;
        $status     = $request->status;
        $user       = User::find($id);

        if(!empty($password)) {
            $user->password = bcrypt($password);
        }

        $user->status   = $status;
        $user->save();

        return redirect()->route('user.management.index')->with('updated', 'Data User has been successfully updated!');
    }
}
