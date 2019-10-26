<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use DB;

class ApiController extends Controller
{
    public function actionApprove($id)
    {
        $inv = Inventory::find($id);

        if($inv->status != 0) {
            return redirect()->route('mail-action')->with('fail', 'Inventory status has changed');
        } else {

            $inv->status = '1';
            $inv->save();

            return redirect()->route('mail-action')->with('success', 'Inventory status successfully updated');
        }
    }

    public function actionReject($id)
    {
        $inv = Inventory::find($id);

        if($inv->status != 0) {
            return redirect()->route('mail-action')->with('fail', 'Inventory status has changed');
        } else {
            $inv->status = '2';
            $inv->save();

            return redirect()->route('mail-action')->with('success', 'Inventory status successfully updated');
        }
    }

    public function index()
    {
        return view('mail-action');
    }
}
