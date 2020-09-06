<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

class Admin {
  public static function get_all(){
    $admin = DB::table('role_user')
    ->select('role_user.*', 'roles.name', 'users.*')
    ->where('roles.name', '=', 'ROLE_ADMIN')
    ->join('roles', 'role_user.role_id', '=', 'roles.id')
    ->join('users', 'role_user.user_id', '=', 'users.id')
    ->get();
    return $admin;
    }

    public static function find_by_id($id){
        $admin = DB::table('users')->where('id', $id)->first();
        return $admin;
    }

      public static function update($id, $request){
        $admin = DB::table('users')
                  ->where('id', $id)
                  ->update([
                    'name' => $request["name"],
                    'password' => $request["password"],
                    'email' => $request["email"],
                    'age' => $request["age"],
                    'address' => $request["address"],
                    'gender' => $request["gender"],
                    'phone' => $request["phone"],
                    'role_id' => $request["role_id"]
                  ]);
        return $item;
      }

      public static function destroy($id){
        $deleted = DB::table('users')
                      ->where('id', $id)
                      ->delete();
        return $deleted;
      }
  }
