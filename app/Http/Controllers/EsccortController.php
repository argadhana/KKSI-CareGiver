<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Esccort;
class EsccortController extends Controller
{
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
        //dd($request->all());
        //
        $request -> validate([
            'salary' => 'required',
            'keahlian' => 'required',
            'name'    => 'required',
            'age'         => 'required',
            'address'       => 'required',
            'gender'        => 'required',
            'phone'  => 'required',
            'photo' => 'required|image'
        ]);

        $photo = $request->file('photo');

        $new_name = rand() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('images'), $new_name);
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
