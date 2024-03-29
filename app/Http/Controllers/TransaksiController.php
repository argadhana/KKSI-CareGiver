<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\User;
use App\Esccort;
use App\Lansia;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Http;



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
            ->select('esccorts.name AS esccort_name','users.name AS user_name','transaksis.id AS idtrans','transaksis.*','users.*','lansias.*','esccorts.*');
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
            ->select('esccorts.name AS esccort_name','users.name AS user_name','transaksis.id AS idtrans','transaksis.*','users.*','lansias.*','esccorts.*')
            ->whereIn('status',['belum','menunggu','dikonfirmasi','merawat','ditolak','diterima']);
            return Datatables::of($transaksi)
                ->make(true);
        }
    }

    public $successStatus = 200;

    public function loadid($id)
    {
        $transaksi = Transaksi::where('user_id',$id)->latest('order_time')->get();
        if ($transaksi == '[]') {
            return response()->json(['success' => ""], 202);
        }else{
            $idlansia = $transaksi[0]['lansia_id'];
            $lansia = Lansia::find($idlansia);
            return response()->json(['success' => $lansia], $this->successStatus);
        }
    }
    public function pesan(Request $request)
    {
        if ($request->lansiauses == 'baru') {
            $escort = new Lansia;
            $escort->nama = $request->nama;
            $escort->umur = $request->umur;
            $escort->gender = $request->gender;
            $escort->hobi = $request->hobi;
            $escort->riwayat = $request->riwayat;
            $escort->save();
            $idlansia = $escort->id;
        }
        elseif ($request->lansiauses == 'lama') {
            if ($request->lansia_id == '') {
                $escort = new Lansia;
                $escort->nama = $request->nama;
                $escort->umur = $request->umur;
                $escort->gender = $request->gender;
                $escort->hobi = $request->hobi;
                $escort->riwayat = $request->riwayat;
                $escort->save();
                $idlansia = $escort->id;
            }
            else {
                $idlansia = $request->lansia_id;
            } 
        }

        $transaksi = new Transaksi;
        $transaksi->paket = $request->paket;
        $transaksi->durasi = $request->durasi;
        $transaksi->alamat = $request->alamat;
        $transaksi->nomor_telp = $request->nomor_telp;
        $transaksi->deskripsi_kerja = $request->deskripsi_kerja;
        $transaksi->user_id = $request->user_id;
        $transaksi->esccort_id = $request->esccort_id;
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
        
        return response()->json(['success' => $transaksi]);
    }
    public function statusall(Request $request)
    {
        $transaksi = Transaksi::join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->join('lansias', 'transaksis.lansia_id', '=', 'lansias.id')
        ->join('users', 'transaksis.user_id', '=', 'users.id')
        ->select('esccorts.name AS esccort_name',
        'esccorts.gender AS esccort_gender',
        'lansias.gender AS lansia_gender',
        'transaksis.id AS transaksi_id',
        'lansias.nama AS lansia_name',
        'esccorts.id AS esccort_id',
        'esccorts.user_id AS userid-dupe',
        'lansias.id AS lansia_id',
        'users.name AS user_name',
        'transaksis.*',
        'esccorts.*',
        'lansias.*')
        ->where('transaksis.user_id',$request->iduser)
        ->get();
        if ($transaksi == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusBelum($id)
    {
        $transaksi = Transaksi::where('user_id',$id)
        ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->where('status','belum')
        ->select('transaksis.id AS idtrans','esccorts.id AS idesccort','transaksis.*','esccorts.*')
        ->get();
        
        if ($transaksi == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusMenunggu($id)
    {
        $transaksi = Transaksi::where('user_id',$id)
        ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->where('status','menunggu')
        ->select('transaksis.id AS idtrans','esccorts.id AS idesccort','transaksis.*','esccorts.*')
        ->get();
    
        if ($transaksi == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusDikonfirmasi($id)
    {
        $transaksi = Transaksi::where('user_id',$id)
        ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->where('status','dikonfirmasi')
        ->select('transaksis.id AS idtrans','esccorts.id AS idesccort','transaksis.*','esccorts.*')
        ->get();
    
        if ($transaksi == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusMerawat($id)
    {
        $transaksi = Transaksi::where('user_id',$id)
        ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->where('status','merawat')
        ->select('transaksis.id AS idtrans','esccorts.id AS idesccort','transaksis.*','esccorts.*')
        ->get();
        
        if ($transaksi == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function statusSelesai($id)
    {
        $transaksi = Transaksi::where('user_id',$id)
        ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->whereIn('status',['ditolak','diterima'])
        ->select('transaksis.id AS idtrans','esccorts.id AS idesccort','transaksis.*','esccorts.*')
        ->get();
    
        if ($transaksi == '[]') {
            return response()->json(['failed' => 'Data tidak ditemukan'],401);    
        }else {
            return response()->json(['success' => $transaksi], $this->successStatus);
        }
    }
    public function uploadBuktiTransaksi(Request $request)
    {
        $image = $request->file('bukti_foto');

        if (!$image) {
            return response()->json(['error' => 'kamu belum upload foto']);
        }
        else {
        $new_name = 'buktitransaksi' . $request->id . '-' . rand(11111, 99999)  . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('buktiPhotos'), $new_name); 

        $transaksi = array(
            'status' => 'menunggu',
            'bukti_foto' => $new_name,
        );

        Transaksi::whereId($request->id)->update($transaksi);

        return response()->json(['success' => 'Foto Berhasil Diupload']);
        
        }
    }
    public function loadTransaksi($id)
    {
        $transaksidetail = Transaksi::where('transaksis.id',$id)
        ->join('esccorts', 'transaksis.esccort_id', '=', 'esccorts.id')
        ->join('lansias', 'transaksis.lansia_id', '=', 'lansias.id')
        ->join('users', 'transaksis.user_id', '=', 'users.id')
        ->select('esccorts.name AS esccort_name',
        'esccorts.gender AS esccort_gender',
        'lansias.gender AS lansia_gender',
        'transaksis.id AS transaksi_id',
        'lansias.nama AS lansia_name',
        'esccorts.id AS esccort_id',
        'lansias.id AS lansia_id',
        'users.name AS user_name',
        'transaksis.*',
        'esccorts.*',
        'lansias.*')
        ->get();

        return response()->json(['success' => $transaksidetail]);
    }
    public function updatestatus(Request $request)
    {   
        $t = Transaksi::whereId($request->id);
        
        $t->update(['status' => $request->status]);
        $now = Carbon::now();  

        if ($request->status == 'diterima') {
            $t->update(['complate_time' => $now]);
        }

        $idusersss = $t->first('user_id');
        $token = User::whereId($idusersss->user_id)->first('notif_token');

        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => 'key=AAAAqtW2dgM:APA91bEKhY6de7x3grzt1SrevEvSUymf8KSx6YW-IjCP2FXi8kBgKs57xhMPtgP91k5basNJ3_0ENyNS8SDegL-qWboNKCWyDOLN0apqXo42TgSac_y2Yf21Exv9CDURsjRVZn5faRYp'
        ])->post('https://fcm.googleapis.com/fcm/send',[
            "to" => $token->notif_token,
          "notification" => [
                "body" => "Status transaksi anda sudah di update menjadi ".$request->status." pada ".$now,
                "title"=> "Pemberitahuan Transaksi"
            ]
        ]);

        return response()->json(['success' => 'Data Berhasil Diupdate']);
    }
    public function getPesanCg(Request $request)
    {
        $t = Transaksi::where('esccort_id',$request->id)
        ->join('lansias', 'transaksis.lansia_id', '=', 'lansias.id')
        ->select('transaksis.id AS transaksi_id',
        'lansias.id AS lansia_id',
        'transaksis.*',
        'lansias.*')
        ->get();
        if ($t == '[]') {
            return response()->json('Data Kosong',202);
        }else {
            return response()->json($t, 200);
        }
    }
}
