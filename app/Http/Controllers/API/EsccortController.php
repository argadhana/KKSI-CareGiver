<?php

namespace App\Http\Controllers\API;

use App\Esccort;
use App\Http\Controllers\Controller;
use App\Http\Resources\EsccortCollection;
use App\Http\Resources\EsccortItem;
use Illuminate\Http\Request;

class EsccortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EsccortCollection(Esccort::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Esccort  $esccort
     * @return \Illuminate\Http\Response
     */
    public function show(Esccort $esccort)
    {
        return new esccortItem($esccort);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Esccort  $esccort
     * @return \Illuminate\Http\Response
     */
    public function edit(Esccort $esccort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Esccort  $esccort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Esccort $esccort)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Esccort  $esccort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Esccort $esccort)
    {
        //
    }
}
