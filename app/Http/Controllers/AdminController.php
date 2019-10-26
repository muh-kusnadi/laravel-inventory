<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function edit($id)
    {
        $user = Admin::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $id         = $request->admin_id;
        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;

        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|unique:admins,email,'.$id,
            'password'              => 'confirmed',
        ];
        $niceNames = [
            'name'                  => 'Name',
            'email'                 => 'E-Mail',
            'password'              => 'Password',
        ];

        $this->validate($request, $rules, [], $niceNames);

        $user = Admin::find($id);

        $user->name     = $name;
        $user->email    = $email;
        if(!empty($password)){
            $user->password = bcrypt($password);
        }
        $user->save();

        return redirect()->route('admin.home')->with('updated', 'Data Admin has been successfully updated!');
    }
}
