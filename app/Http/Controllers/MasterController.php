<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lansia;
use DataTables;

class MasterController extends Controller
{
    public function anjay()
    {
        return view('master.data_lansia');
    }
    public function getDataLansia(Request $request)
    {
        if ($request->ajax()) {
            $lansia = Lansia::select('*');
            return Datatables::of($lansia)
                ->make(true);
        }
    }
}
