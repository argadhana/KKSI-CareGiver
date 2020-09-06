<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

class CustomerModel {

    public static function get_customer()
    {
        $customer = DB::table('role_user')
            ->select('role_user.*', 'roles.name', 'users.*')
            ->where('roles.name', '!=', 'ROLE_ADMIN')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->get();
        return $customer;
    }
}
