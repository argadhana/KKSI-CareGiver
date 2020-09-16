<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

class EsccortModel {
    public static function find_by_id($id){
        $esccort = DB::table('esccorts')->where('id', $id)->first();
        return $esccort;
      }
    public static function update($id, $request){
    $esccort = DB::table('esccorts')
            ->where('id', $id)
            ->update([
                'name' => $request["name"],
                'salary' => $request["salary"],
                'keahlian' => $request["keahlian"],
                'age' => $request["age"],
                'address' => $request["address"],
                'gender' => $request["gender"],
                'phone' => $request["phone"],
                'photo' => $request["photo"]
            ]);
    return $esccort;
    }

    public static function destroy($id){
        $deleted = DB::table('esccorts')
                      ->where('id', $id)
                      ->delete();
        return $deleted;
    }
}
