<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Praktikum\{
    MatkulPraktikum,
    PendaftarAcc,
};
use App\Models\{Dosen, AkunMhs, Periode, User};

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

    public function indexDataPengguna()
    {
        $user = User::orderBy('role', 'asc')->get();
        return view('admin.master.indexUser', compact('user'));
    }
    public function resetPengguna(Request $request)
    {
        User::find($request->kode_user)->update([
            'status' => 'aktif',
        ]);
        return redirect()->back()->with('success', 'Akun pengguna berhasil dipulihkan');
    }
    public function blockPengguna(Request $request)
    {
        User::find($request->kode_user)->update([
            'status' => 'block',
        ]);
        return redirect()->back()->with('success', 'Akun pengguna telah di block');
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
        $matkum = MatkulPraktikum::create([
            'nama_mp' => $request->nm_prak,
            'harga' => $request->harga,
            'deskripsi' => $request->desk,
        ]);
        PendaftarAcc::create([
            'id_periode' => $request->currentPeriode,
            'id_mp' => $matkum->id_mp,
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
        ->back()
        ->with('success', 'Berhasil menghapus praktikum');
    }

    //controller dosen
    public function tambahDataDosen()
    {
        return view('admin.master.tambahDosen');
    }
    public function editDataDosen($id)
    {
        $dosen = Dosen::find($id);
        return view('admin.master.editDosen', compact('dosen'));
    }
    public function saveDataDosen(Request $request)
    {
        Dosen::create([
            'nama' => $request->nm_dosen,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()
        ->route('adm.master.dsn')
        ->with('success', 'Berhasil menambahkan data dosen');
    }
    public function deleteDataDosen(Request $request)
    {
        Dosen::find($request->kode_dosen)->delete();

        return redirect()
        ->back()
        ->with('success', 'Berhasil menghapus data dosen');
    }
    public function updateDataDosen(Request $request)
    {
        Dosen::find($request->kode_dosen)->update([
            'nama' => $request->nm_dosen,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()
        ->route('adm.master.dsn')
        ->with('success', 'Berhasil mengubah data dosen');
    }



}
