<?php

namespace App\Http\Controllers;

use App\Models\Inventaris\{InvPermohonan, InvAlatBahan};
use Illuminate\Http\Request;


class AdminInventaris extends Controller
{
    public function indexDataPermohon()
    {
        $permohonan = InvPermohonan::all();
        return view('admin.inventaris.indexPermohonan', compact('permohonan'));
    }
    public function tambahDataPermohon()
    {
        return view('admin.inventaris.tambahPermohonan');
    }
    public function saveDataPermohon(Request $request)
    {
        InvPermohonan::create($request->all());
        return redirect()->route('adm.inv.permohon')->with('Berhasil menambah data inventaris');
    }
    public function editDataPermohon($id)
    {
        $row = InvPermohonan::find($id);
        return view('admin.inventaris.editPermohonan', compact('row'));
    }
    public function updateDataPermohon(Request $request)
    {
        InvPermohonan::find($request->kode)->update($request->all());
        return redirect()->route('adm.inv.permohon')->with('Berhasil mengubah data inventaris');
    }
    public function deleteDataPermohon(Request $request)
    {
        InvPermohonan::find($request->kode)->delete();
        return redirect()->back()->with('Berhasil menghapus data inventaris');
    }

    public function indexDataBahan()
    {
        $bahan = InvAlatBahan::all();
        return view('admin.inventaris.indexAlatBahan', compact('bahan'));
    }
    public function tambahDataBahan()
    {
        return view('admin.inventaris.tambahAlatBahan');
    }
    public function saveDataBahan(Request $request)
    {
        InvAlatBahan::create($request->all());
        return redirect()->route('adm.inv.bahan')->with('Berhasil menambahkan data inventaris');
    }
    public function deleteDataBahan(Request $request)
    {
        InvAlatBahan::find($request->kode)->delete();
        return redirect()->back()->with('Berhasil menghapus data inventaris');
    }
    public function editDataBahan($id)
    {
        $row = InvAlatBahan::find($id);
        return view('admin.inventaris.editAlatBahan', compact('row'));
    }
    public function updateDataBahan(Request $request)
    {
        InvAlatBahan::find($request->kode)->update($request->all());
        return redirect()->route('adm.inv.bahan')->with('Berhasil mengubah data inventaris');
    }


}