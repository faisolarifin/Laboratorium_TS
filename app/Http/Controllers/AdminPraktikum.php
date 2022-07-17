<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    DaftarKelompok,
    DaftarAnggotaKelompok,
    DaftarPraktikum,
    DaftarPraktikumd,
    Dosen,
    JadwalPraktikum,
    MatkulPraktikum,
    PendaftarAcc,
    PendaftarAccd};

class AdminPraktikum extends Controller
{
    public function listPendaftarPraktikum(Request $request)
    {
        $id_periode = $request->currentPeriode;
        $pendaftar = DaftarPraktikum::where([
            'id_periode' => $id_periode
            ])->with('periode')
        ->with('mhs')->get();
        
        return view('admin.praktikum.pendaftarPraktikum', compact('pendaftar'));
    }
    
    public function accBayarPraktikum(Request $request)
    {;
        DaftarPraktikum::find($request->kode_daftar)->update([
            'status_bayar' => 'lunas',
        ]);
        return redirect()->back();
    }

    public function accTerimaPraktikum(Request $request)
    {
        $id_periode = $request->currentPeriode;
        DaftarPraktikum::find($request->kode_daftar)->update([
            'status_bayar' => 'lunas',
            'status_acc_fix' => 'terima',
        ]);

        $detail_daftar_matkum = DaftarPraktikumd::where([
            'id_daftarmp' => $request->kode_daftar,
            ])->with('matkum')->get();
           
        foreach($detail_daftar_matkum as $row) {
            $matkum_per_periode = PendaftarAcc::where([
                'id_periode' => $id_periode,
                'id_mp' => $row->id_mp
            ])->first();

            if ($matkum_per_periode !== null) {
                if (PendaftarAccd::where([
                    'id_daftar' => $matkum_per_periode->id_daftar,
                    'id_mhs' => $request->kode_mhs,
                ])->first() == null) 
                {
                    PendaftarAccd::create([
                        'id_daftar' => $matkum_per_periode->id_daftar,
                        'id_mhs' => $request->kode_mhs, 
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    public function listPendaftarPraktikumById(Request $request, $id)
    {
        $id_periode = $request->currentPeriode;
        $pendaftar = DaftarPraktikum::where([
            'id_daftarmp' => $id,
            'id_periode' => $id_periode,
        ])->with('periode')
        ->with('mhs')->first();

        $detail_daftar_matkum = DaftarPraktikumd::where([
            'id_daftarmp' => $pendaftar->id_daftarmp,
        ])->with('matkum')->get();
       
        return view('admin.praktikum.detailpendaftarPraktikum', compact('pendaftar', 'detail_daftar_matkum'));
    }

    public function listPerdaftarPerMatkum(Request $request, $id_dft=1)
    {
        $id_periode = $request->currentPeriode;
        $matkum_periode = PendaftarAcc::where([
            'id_periode' => $id_periode,
        ])->with('matkum')->get();

        $list_pendaftar = PendaftarAccd::where([
            'id_daftar' => $id_dft,
        ])->with('mhs')->get();
        
        return view('admin.praktikum.pendaftarPerMatkum', compact('matkum_periode', 'list_pendaftar'));
    }

    public function generateKelompokPraktikum(Request $request)
    {
        ##buat kelompok
        $Lmhs = PendaftarAccd::where([
            'id_daftar' => $request->kode_daftar,
        ])->pluck('id_mhs')->toArray();

        $n = count($Lmhs);
        $x = range(0, $n-1);shuffle($x);
        $Lkel = array();
        
        $nk = $request->jml_kelompok;
        $isi=true;
        for($i=0;$i<$nk;$i++) {
            array_push($Lkel, array());
        }
        $i=-1;
        $j=-1;
        $sign=-1;

        while ($isi == true) {
            $i +=1;
            $j +=1;
            $sign +=1;
            array_push($Lkel[$i], $Lmhs[$x[$j]]);
            if ($i== $nk-1) {
                $i = -1;
            }
            if ($sign == $n-1) {
                $isi=false;
            }
        }

        $accById = PendaftarAcc::where([
            'id_daftar' => $request->kode_daftar,
        ])->first();

        foreach($Lkel as $i=>$kel) {
            $create_kel = DaftarKelompok::create([
                'id_periode' => $accById->id_periode,
                'id_mp' => $accById->id_mp,
                'nm_kel' => str('Kelompok '.$i+1),
            ]);
            foreach($kel as $row) {
                DaftarAnggotaKelompok::create([
                    'id_kel' => $create_kel->id_kel,
                    'id_mhs' => $row,
                    'nilai' => '',
                ]);
            }
        }
        #ubah status generate
        PendaftarAcc::find($request->kode_daftar)->update([
            'status_generate' => '1',
        ]);

        return redirect()->route('adm.prak.kelompok', $accById->id_mp);
    }

    public function kelompokPerdaftarPerMatkum(Request $request, $id_mp=1)
    {
        $id_periode = $request->currentPeriode;
        $matkum_periode = MatkulPraktikum::all();
        $dosen = Dosen::all();

        $list_kelompok = DaftarKelompok::where([
            'id_periode' => $id_periode,
            'id_mp' => $id_mp,
        ])->with('pbb')->with('pgj')->with('pgj2')->get();

        return view('admin.praktikum.kelompokPerMatkum', compact('matkum_periode', 'list_kelompok', 'dosen'));
    }

    public function updateKelompokPraktikum(Request $request)
    {
        DaftarKelompok::where(['id_kel' => $request->kode_kel])->update([
            'tgl_ujian' => $request->tgl_ujian,
            'pembimbing' => $request->dsn_pembimbing,
            'penguji' => $request->dsn_penguji,
        ]);
        return redirect()->back()->with('success', 'Perubahan data kelompok berhasil');
    }

    public function hapusKelompokPraktikum(Request $request)
    {
        DaftarAnggotaKelompok::where([
            'id_kel' => $request->kode_kel,
        ])->delete();
        DaftarKelompok::find($request->kode_kel)->delete();

        return redirect()->back();
    }

    public function anggotaKelompokPraktikum($kode_kel)
    {
        $matkum = DaftarKelompok::where([
            'id_kel' => $kode_kel,
        ])->with('periode')->with('matkum')->first();
        
        $anggota_kel = DaftarAnggotaKelompok::where([
            'id_kel' => $kode_kel,
        ])->with('mhs')->get();

        return view('admin.praktikum.anggotaKelompokPraktikum', compact('matkum', 'anggota_kel'));
    }
    public function updateNilaiPraktikum(Request $request)
    {
        DaftarAnggotaKelompok::where([
            'id_kel' => $request->kode_kel,
            'id_mhs' => $request->kode_mhs,
        ])->update([
            'nilai' => $request->nilai
        ]);
        return redirect()->back()->with('success', 'Nilai praktikum berhasil ditambahkan');
    }
    public function jadwalKelompokPraktikum($kode_kel)
    {
        $matkum = DaftarKelompok::where([
            'id_kel' => $kode_kel,
        ])->with('periode')->with('matkum')->first();

        $jadwal_prak = JadwalPraktikum::where([
            'id_kel' => $kode_kel,
        ])->get();        

        return view('admin.praktikum.jadwalKelompokPraktikum', compact('matkum', 'jadwal_prak'));
    }
    public function saveJadwalPraktikum(Request $request)
    {
        JadwalPraktikum::create([
            'id_kel' => $request->kode_kel,
            'tgl_prak' => $request->tgl_prak,
        ]);
        //pesan sukses

        return redirect()->back();
    }
    public function hapusJadwalPraktikum(Request $request)
    {
        JadwalPraktikum::where([
            'id_jadwal' => $request->kode_jad,
        ])->delete();        
        return redirect()->back()->with('Jadwal berhasil dihapus');
    }

    public function historyPraktikum(Request $request, $id_mp=1)
    {
        $id_periode = $request->currentPeriode;
        $matkum_periode = MatkulPraktikum::all();

        $hist_praktikum = DaftarAnggotaKelompok::whereRelation("parent", [
            'id_mp' => $id_mp,
        ])->with(['parent' => function($q) use ($id_mp){
            $q->where([
                'id_mp' => $id_mp,
            ])->with('periode')->with('matkum');
        }])->with('mhs')
        ->get();

        return view('admin.praktikum.historyPraktikum', compact('matkum_periode', 'hist_praktikum'));
    }
    
    public function createPeriode()
    {
        $id_periode = 1; //sesuikan dengan di pengaturan
        foreach(MatkulPraktikum::all() as $row){
            if (PendaftarAcc::where([
                'id_mp' => $row->id_mp,
                'id_periode' => $id_periode,
                ])->first() == null)
            {
                PendaftarAcc::create([
                    'id_mp' => $row->id_mp,
                    'id_periode' => $id_periode,
                ]);
            }
        }

    }
}
