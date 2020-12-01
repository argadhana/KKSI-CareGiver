<?php

namespace App\Http\Controllers\API;

use App\Esccort;
use App\Transaksi;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\EsccortCollection;
use App\Http\Resources\EsccortItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsccortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        // $userid = Auth::id();
        $esccort = Esccort::where('id',$request->escortid)->first();
        $user = User::where('id',$request->userid)->first();
        
        $user->rate($esccort, $request->stars);
        
        return response()->json('anjay');
    }
    public function getrate(Request $request)
    {
        $esccort = Esccort::where('id',$request->escortid)->first();
        $rating = $esccort->ratingsAvg();
        if ($rating == "") {
            return response()->json('belum ada rating',202);
        }else {
            return response()->json($rating);
        }
    }
    public function index()
    {
        $esccort = new Esccort;

        $esccortsudah = $esccort->join('transaksis', 'transaksis.esccort_id', '=', 'esccorts.id')
                                ->select('esccorts.id AS id')
                                ->whereIn('status',['menunggu','dikonfirmasi','merawat'])
                                ->pluck('id');
        $esccortbelum = $esccort->get();

        $es = $esccortsudah;
        $eb = new EsccortCollection($esccortbelum);
        // $cgall = ['dalam_proses' => $es,
        //           'tidak_dalam_proses' => $eb];
        return response()->json(['data' => $eb,
                                 'dalam_proses' => $es]);
    }
    public function getcg($id)
    {
        $escort = Transaksi::where('esccort_id',$id)
        ->whereIn('status',['menunggu','dikonfirmasi','merawat'])
        ->select('esccort_id AS id','status')
        ->get();
        
        if ($escort == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);
        }else {
            return response()->json(['success' => $escort]);
        }
        
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
