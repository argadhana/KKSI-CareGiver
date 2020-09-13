<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\User;
use App\Esccort;
use App\Lansia;
use DataTables;



class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.pemesanan');
    }
    public function indexverif()
    {
        return view('transaksi.verifikasi');
    }
    public function getDataTransaksi(Request $request)
    {
        if ($request->ajax()) {
            $transaksi = Transaksi::select('*')
            ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
            ->join('users', 'transaksis.user_id', '=', 'users.id')
            ->join('lansias', 'transaksis.lansia_id', '=', 'lansias.id')
            ->select('esccorts.name AS esccort_name','transaksis.id AS idtrans','transaksis.*','users.*','lansias.*');
            return Datatables::of($transaksi)
                ->make(true);
        }
    }
    public function getDataVerif(Request $request)
    {
        if ($request->ajax()) {
            $transaksi = Transaksi::select('*')
            ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
            ->join('users', 'transaksis.user_id', '=', 'users.id')
            ->join('lansias', 'transaksis.lansia_id', '=', 'lansias.id')
            ->select('esccorts.name AS esccort_name','transaksis.id AS idtrans','transaksis.*','users.*','lansias.*')
            ->where('status','belum');
            return Datatables::of($transaksi)
                ->make(true);
        }
    }

    public $successStatus = 200;

    public function loadid($id)
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('user_id',$id)->get();
            if ($transaksi == '[]') {
                return response()->json(['success' => ""], 202);
            }else{
                $idlansia = $transaksi[0]['lansia_id'];
                $lansia = Lansia::find($idlansia);
                return response()->json(['success' => $lansia], $this->successStatus);
            }
        }
    }
    public function pesan(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->idlansia == '') {
                $escort = new Lansia;
                $escort->nama = $request->nama;
                $escort->umur = $request->umur;
                $escort->gender = $request->gender;
                $escort->hobi = $request->hobi;
                $escort->riwayat = $request->riwayat;
                $escort->save();
                $idlansia = $escort->id;
            } else {
                $idlansia = $request->idlansia;
            }

            $transaksi = new Transaksi;
            $transaksi->paket = $request->paket;
            $transaksi->durasi = $request->durasi;
            $transaksi->alamat = $request->alamat;
            $transaksi->nomor_telp = $request->nomor;
            $transaksi->deskripsi_kerja = $request->deskripsi;
            $transaksi->user_id = $request->iduser;
            $transaksi->esccort_id = $request->idesccort;
            // $transaksi->esccort_id = '1';
            $transaksi->lansia_id = $idlansia;
            $transaksi->status = 'belum';

            if ($request->paket == "bulanan") {
                $total = $request->durasi * 2000000;
            }if ($request->paket == "harian") {
                $total = $request->durasi * 150000;
            }
            $transaksi->total_bayar = $total;

            $transaksi->save();
            
            return response()->json(['success' => "horee"], $this->successStatus);
        }
    }
    public function statusBelum()
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('status','belum')->get();
        
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusMenunggu()
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('status','menunggu')->get();
        
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusDikonfirmasi()
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('status','dikonfimasi')->get();
        
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusMerawat()
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('status','merawat')->get();
        
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusDitolak()
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('status','ditolak')->get();
        
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusDiterima()
    {
        if(request()->ajax())
        {
            $transaksi = Transaksi::where('status','diterima')->get();
        
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function uploadBuktiTransaksi(Request $request)
    {
        if(request()->ajax())
        {
            // $transaksi = Transaksi::where('id', $request->id)->get();
            $image = $request->file('bukti_foto');

            $new_name = 'buktitransaksi' . $request->id . '-' . rand(11111, 99999)  . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('buktiPhotos'), $new_name); 

            $transaksi = array(
                'status' => 'menunggu',
                'bukti_foto' => $new_name,
            );

            Transaksi::whereId($request->id)->update($transaksi);

            return response()->json(['success' => 'qamu berhasil dech'], $this->successStatus);
        }
    }
}
