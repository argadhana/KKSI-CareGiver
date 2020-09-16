<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Esccort;
use App\Models\EsccortModel;
class EsccortController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $esccort = Esccort::all();
        return view ('admin.data_esccort', compact('esccort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $esccort = Esccort::all();
        return view ('admin.form_esccort', compact('esccort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return redirect('/data-esccort');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

            $esccort = Esccort::find($id);
            return view('admin.show_esccort', compact('esccort'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $esccort = EsccortModel::find_by_id($id);
        return view ('admin.edit_esccort', compact('esccort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $esccort = Esccort::update($id, $request->all());
        return redirect('/data-esccort');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $deleted = EsccortModel::destroy($id);
        return redirect('/data-esccort');
    }
}
