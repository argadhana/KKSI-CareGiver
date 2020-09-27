<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lansia;
use App\Esccort;
use DataTables;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class MasterController extends Controller
{
    public function lansia()
    {
        return view('master.data_lansia');
    }
    public function getDataLansia(Request $request)
    {
        if ($request->ajax()) {
            $lansia = Lansia::select('*');
            return Datatables::of($lansia)
                ->addColumn('aksi', function ($lansia) {
                    return
                        '<button id="buttondeletelansia" data-idlansia="'.$lansia->id.'" class="btn btn-danger mr-1 btnhapuslansia"><i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
    public function getDataEsccort(Request $request)
    {
        if ($request->ajax()) {
            $cg = Esccort::select('*');
            return Datatables::of($cg)
                ->addColumn('aksi', function ($cg) {
                    return
                        '<button id="buttondeletecg" data-idcg="'.$cg->id.'" class="btn btn-danger mr-1 btnhapuscg"><i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
    public function del($id)
    {
        $note=Lansia::findOrFail($id);
        $note->delete();

        return response()->json(['success' => 'Data Berhasil Dihapus.']);
    }
    public function filtercg(Request $request)
    {
        $lansia = DB::table('esccorts');
        if (!$request->age1 && !$request->age2) {
            $lansia->where('gender',$request->gender);
        }elseif (!$request->age2) {
            $lansia->where('age',$request->age1);
        }elseif (!$request->gender) {
            $lansia->whereBetween('age', array($request->age1, $request->age2));
        }else {
            $lansia->whereBetween('age', array($request->age1, $request->age2))->where('gender',$request->gender);
        }
        // ->whereBetween('age', array($request->age1, $request->age2))
        // ->get();
        $lansias = $lansia->get();
        $esccort = new Esccort;

        $esccortsudah = $esccort->join('transaksis', 'transaksis.esccort_id', '=', 'esccorts.id')
                                ->select('esccorts.id AS id')
                                ->whereIn('status',['menunggu','dikonfirmasi','merawat'])
                                ->pluck('id');

        if ($lansias == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $lansias,
                                     'dalam_proses' => $esccortsudah]);
        }
    }
    public function simpan(Request $request)
    {
        $rules = array(
            'nama'=>'required|unique:lansias',
            'umur'   =>  'required',
            'hobi'   =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nama'=>$request->nama,
            'umur'=>$request->umur,
            'gender'=>$request->gender,
            'hobi'=>$request->hobi,
            'riwayat'=>$request->riwayat,
        );

        Lansia::create($form_data);

        return response()->json(['success' => 'Data berhasil dibuat']);

    }
    public function loadlansia($id)
    {
        $lansia = Lansia::findOrFail($id);
        return response()->json(['success' => $lansia]);
    }
    public function updatelansia(Request $request)
    {
        $rules = array(
            'nama' => [Rule::unique('lansias', 'id')->where(function ($query) use ($request) {
                return $query->where('id','=', $request->hidden_id);
            }),],
            'umur'   =>  'required',
            'hobi'   =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nama'=>$request->nama,
            'umur'=>$request->umur,
            'gender'=>$request->gender,
            'hobi'=>$request->hobi,
            'riwayat'=>$request->riwayat,
        );

        Lansia::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data berhasil diupdate']);
    }
}
