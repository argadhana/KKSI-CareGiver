<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;
use App\User;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }

    public function index()
    {
        //
        return view ('master.data_customer');
    }

    public function getDataCustomer(Request $request)
    {
        if ($request->ajax()) {
            $cg = User::all();
            return Datatables::of($cg)
                ->addColumn('aksi', function ($cg) {
                    return
                        '<button id="buttondeletecg" data-idcg="'.$cg->id.'" class="btn btn-danger mr-1 btnhapuscg"><i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $customer = User::find($id);
        return view('admin.show_customer', compact('customer'));
    }

}
