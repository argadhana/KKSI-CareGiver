<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $customer = User::all();
        return view ('admin.data_customer', compact('customer'));
    }

    public function show($id)
    {
        $customer = User::find($id);
        return view('admin.show_customer', compact('customer'));
    }

}
