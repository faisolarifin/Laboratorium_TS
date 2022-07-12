<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    DaftarAnggotaKelompok,
    DaftarKelompok,
    MatkulPraktikum,
    DaftarPraktikum,
    DaftarPraktikumd,
    JadwalPraktikum,
    PendaftarAcc,
    Setting,
};

class MhsPraktikum extends Controller
{
    public function listMatkulPraktikum(Request $request)
    {
        $matkum = MatkulPraktikum::all();
        return view('praktikum.listMatkum', compact('matkum'));
    }

    public function addMatkulPraktikum(Request $request)
    {  
        $mhs_id = $request->session()->get('id');
        $id_periode = $request->currentPeriode; 
        
        if (Setting::find(4)->value == 'off' ) return redirect()
        ->back()->with('error', 'Pendaftaran praktikum sudah ditutup!');
        
        $cek_daftar = DaftarPraktikum::where([
            'id_mhs' => $mhs_id,
            'id_periode' => $id_periode
        ])->first();
        
        if ($cek_daftar == null) {
            $daftar_id = DaftarPraktikum::create([
                'id_mhs' => $mhs_id,
                'id_periode' => $id_periode,
                'status_bayar' => 'belum',
                'status_acc_fix' => 'belum',
                ])->id_daftarmp;   

        } else {

            if ($cek_daftar->status_bayar == 'lunas') return redirect()
            ->back()->with('error', 'Tidak dapat menambah praktikum. Pembayaran sudah lunas!');

            if ($cek_daftar->status_acc_fix == 'terima') return redirect()
            ->back()->with('error', 'Tidak dapat menambah praktikum. Pendaftaran sudah divalidasi!');
            
            $daftar_id = $cek_daftar->id_daftarmp;
        }

        $cek_matkum = DaftarPraktikumd::where([
            'id_daftarmp' => $daftar_id,
            'id_mp' => $request->id_matkum,
        ])->first();
        
        if ($cek_matkum == null) {
            DaftarPraktikumd::create([
            'id_daftarmp' => $daftar_id,
            'id_mp' => $request->id_matkum,
            ]);  
        } else {
            return redirect()->back()->with('error', 'Anda sudah mendaftar pratikum tersebut!');
        }

        return redirect()->route('mhs.rencana')->with('success', 'Praktikum berhasil ditambahkan');
    }

    public function listPendingDaftar(Request $request)
    {
        $mhs_id = $request->session()->get('id');
        $id_periode = $request->currentPeriode;
        
        $pendaftar = DaftarPraktikum::where([
            'id_mhs' => $mhs_id,
            'id_periode' => $id_periode
        ])->with('periode')
        ->with('mhs')->first();

        if ($pendaftar != null) {
            $matkum_pilih = DaftarPraktikumd::where([
                'id_daftarmp' => $pendaftar->id_daftarmp,
            ])->with('matkum')->get();
           
            return view('praktikum.pilihMatkum', compact('pendaftar', 'matkum_pilih'));
        }
        return view('praktikum.pilihMatkum');
    }

    public function hapusMatkulPraktikum(Request $request)
    {
        DaftarPraktikumd::where([
            'id_daftarmp' => $request->id_daftar,
            'id_mp' => $request->id_matkum,
        ])->delete();

        return redirect()->back()->with('success', 'Praktikum berhasil dihapus');
    }

    public function listAnggotaPraktikum(Request $request, $id=1)
    {
        $periode_id = $request->currentPeriode;
        $mhs_id = $request->session()->get('id');

        $matkum = PendaftarAcc::where([
            'id_periode' => $periode_id,
        ])->whereRelation("detail", [
            'id_mhs' => $mhs_id,
        ])->with('matkum')->get();

        $kelompok = DaftarKelompok::where([
            'id_periode' => $periode_id,
            'id_mp' => $id,
        ])->whereRelation("detail", [
            'id_mhs' => $mhs_id,
        ])->with('pbb')->with('pgj')->first();

        if ($kelompok != null) {

            $anggota = DaftarAnggotaKelompok::where([
                'id_kel' => $kelompok->id_kel,
            ])->with('mhs')->get();
    
            return view('praktikum.anggotaPraktikum', compact('matkum', 'kelompok', 'anggota'));
        }
        return view('praktikum.anggotaPraktikum');

    }

    public function listJadwalPraktikum(Request $request, $id=1)
    {
        $periode_id = $request->currentPeriode;
        $mhs_id = $request->session()->get('id');

        $matkum = PendaftarAcc::where([
            'id_periode' => $periode_id,
        ])->whereRelation("detail", [
            'id_mhs' => $mhs_id,
        ])->with('matkum')->get();

        $kelompok = DaftarKelompok::where([
            'id_periode' => $periode_id,
            'id_mp' => $id,
        ])->whereRelation("detail", [
            'id_mhs' => $mhs_id,
        ])->first();

        if ($kelompok != null) {
            $jadwal = JadwalPraktikum::where([
                'id_kel' => $kelompok->id_kel,
            ])->get();
    
            return view('praktikum.jadwalPraktikum', compact('matkum', 'kelompok', 'jadwal'));
        }
        return view('praktikum.jadwalPraktikum');
    }

    public function nilaiPraktikum(Request $request)
    {
        $periode_id = $request->currentPeriode;
        $mhs_id = $request->session()->get('id');
        $matkum = DaftarKelompok::where([
            'id_periode' => $periode_id,
        ])->whereRelation("detail", [
            'id_mhs' => $mhs_id,
        ])->with('periode')->with('detail')->with('matkum')->get();

        return view('praktikum.nilaiPraktikum', compact('matkum'));
    }   
}
