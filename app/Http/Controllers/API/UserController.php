<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'age' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;
        $success['age'] = $user->age;
        $success['address'] = $user->address;
        $success['gender'] = $user->gender;
        $success['phone'] = $user->phone;

        return response()->json(['success' => $success],$this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function tokenUpdate(Request $request)
    {
        
        $user = User::where('id',$request->id)->first();
        $token = $user->notif_token;
        // return response()->json($token);
        if ($token == $request->token) {
            return response()->json(['success' => 'ok'], 204);
        }
        else {
            $user->update(['notif_token'=> $request->token]);
            // $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => 'berhasil'], 200);
        }
    }

    public function detailesccort(){
        
        $id_user = Auth::user()->id;
        $user = DB::table('users')->join('esccorts','users.id','=','esccorts.user_id')->where('users.id',$id_user)->get();
        return response()->json(['success' => $user], $this->successStatus);
    }
    
}
