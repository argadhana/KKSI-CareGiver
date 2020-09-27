<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Esccort;
use App\Models\EsccortModel;
use Validator;
use Illuminate\Validation\Rule;

class EsccortController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }

    public function index()
    {
        // $esccort = Esccort::all();
        return view ('master.data_cg');
    }

    public function create()
    {
        //
        $esccort = Esccort::all();
        return view ('admin.form_esccort', compact('esccort'));
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'name'=>'required|unique:esccorts',
            'keahlian'   =>  'required',
            'age'   =>  'required',
            'address'   =>  'required',
            'photo'   =>  'required|image',
            'phone'   =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('photo');

        $new_name = 'esccort' . rand(11111, 99999)  . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('esccortPhotos'), $new_name);

        $new_esccort = array(
            'salary' => $request['salary'],
            'keahlian' => $request['keahlian'],
            'name' => $request['name'],
            'age' => $request['age'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'phone' => $request['phone'],
            'photo' => $new_name
        );

        Esccort::create($new_esccort);

        return response()->json(['success' => 'Data berhasil dibuat']);
    }

    public function show($id)
    {

            $esccort = Esccort::find($id);
            return view('admin.show_esccort', compact('esccort'));

    }

    public function edit($id)
    {
        //
        $esccort = Esccort::findOrFail($id);
        return response()->json(['success' => $esccort]);
    }

    public function update(Request $request)
    {
        //
        if (!$request->photo) {
            $rules = array(
                'name' => [Rule::unique('esccorts', 'id')->where(function ($query) use ($request) {
                    return $query->where('id','=', $request->hidden_id);
                }),],
                'keahlian'   =>  'required',
                'age'   =>  'required',
                'address'   =>  'required',
                'phone'   =>  'required'
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $new_esccort = array(
                'salary' => $request['salary'],
                'keahlian' => $request['keahlian'],
                'name' => $request['name'],
                'age' => $request['age'],
                'address' => $request['address'],
                'gender' => $request['gender'],
                'phone' => $request['phone']
            );
        }else {
            $rules = array(
                'name' => [Rule::unique('esccorts', 'id')->where(function ($query) use ($request) {
                    return $query->where('id','=', $request->hidden_id);
                }),],
                'keahlian'   =>  'required',
                'age'   =>  'required',
                'address'   =>  'required',
                'photo'   =>  'required|image',
                'phone'   =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image = $request->file('photo');
    
            $new_name = 'esccort' . rand(11111, 99999)  . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('esccortPhotos'), $new_name);

            $new_esccort = array(
                'salary' => $request['salary'],
                'keahlian' => $request['keahlian'],
                'name' => $request['name'],
                'age' => $request['age'],
                'address' => $request['address'],
                'gender' => $request['gender'],
                'phone' => $request['phone'],
                'photo' => $new_name
            );
        }

        Esccort::whereId($request->hidden_id)->update($new_esccort);

        return response()->json(['success' => 'Data berhasil disimpan']);

    }

    public function destroy($id) {
        $note=Esccort::findOrFail($id);
        $note->delete();

        return response()->json(['success' => 'Data Berhasil Dihapus.']);
    }
}
