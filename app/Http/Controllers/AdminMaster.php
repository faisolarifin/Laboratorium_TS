<?php

namespace App\Http\Controllers;

use App\Models\AkunMhs;
use App\Models\Dosen;
use App\Models\MatkulPraktikum;
use App\Models\PendaftarAcc;
use App\Models\Periode;
use Illuminate\Http\Request;

class AdminMaster extends Controller
{
    public function indexDataMatkum()
    {
        $matkum = MatkulPraktikum::all();
        return view('admin.master.indexMatkum', compact('matkum'));
    }

    public function indexDataPeriode()
    {
        $periode = Periode::all();
        return view('admin.master.indexPeriode', compact('periode'));
    }

    public function indexDataDosen()
    {
        $dosen = Dosen::all();
        return view('admin.master.indexDosen', compact('dosen'));
    }

    public function indexDataMahasiswa()
    {
        $mhs = AkunMhs::all();
        return view('admin.master.indexMhs', compact('mhs'));
    }
    public function tambahDataPeriode()
    {
        return view('admin.master.tambahPeriode');
    }
    public function editDataPeriode($id)
    {
        $periode = Periode::find($id);
        return view('admin.master.editPeriode', compact('periode'));
    }
    public function saveDataPeriode(Request $request)
    {
        $add = Periode::create([
            'thn_ajaran' => $request->thn_ajaran,
            'semester' => $request->smt,
        ]);

        foreach(MatkulPraktikum::all() as $row){
            if (PendaftarAcc::where([
                'id_mp' => $row->id_mp,
                'id_periode' => $add->id_periode,
                ])->first() == null)
            {
                PendaftarAcc::create([
                    'id_mp' => $row->id_mp,
                    'id_periode' => $add->id_periode,
                ]);
            }
        }
        return redirect()
        ->route('adm.master.periode')
        ->with('success', 'Berhasil menambahkan periode');
    }

    public function updateDataPeriode(Request $request)
    {
        Periode::find($request->kode_periode)->update([
            'thn_ajaran' => $request->thn_ajaran,
            'semester' => $request->smt,
        ]);
        return redirect()
        ->route('adm.master.periode')
        ->with('success', 'Berhasil mengubah periode');
    }

    public function tambahDataMatkum()
    {
        return view('admin.master.tambahMatkum');
    }
    public function editDataMatkum($id)
    {
        $matkum = MatkulPraktikum::find($id);
        return view('admin.master.editMatkum', compact('matkum'));
    }

    public function saveDataMatkum(Request $request)
    {
        MatkulPraktikum::create([
            'nama_mp' => $request->nm_prak,
            'harga' => $request->harga,
            'deskripsi' => $request->desk,
        ]);

        return redirect()
        ->route('adm.master.matkum')
        ->with('success', 'Berhasil menambahkan praktikum');
    }
    public function updateDataMatkum(Request $request)
    {
        MatkulPraktikum::find($request->kode_prak)->update([
            'nama_mp' => $request->nm_prak,
            'harga' => $request->harga,
            'deskripsi' => $request->desk,
        ]);

        return redirect()
        ->route('adm.master.matkum')
        ->with('success', 'Berhasil mengubah praktikum');
    }
    public function deleteDataMatkum(Request $request)
    {
        MatkulPraktikum::find($request->kode_prak)->delete();

        return redirect()
        ->route('adm.master.matkum')
        ->with('success', 'Berhasil menghapus praktikum');
    }


    
}
