<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan\{
    Kas,
    KodeKas,
    KasPeriode
};
use App\Models\{
    Periode,
};

class AdminKeuangan extends Controller
{
    public function indexKodeKas()
    {
        $kode = KodeKas::all();
        return view('admin.keuangan.indexKode', compact('kode'));
    }
    public function tambahKodeKas()
    {
        return view('admin.keuangan.tambahKode');
    }
    public function saveKodeKas(Request $request)
    {
        KodeKas::create([
            'nm_kode' => $request->nm_kode,
            'harga' => $request->harga,
            'ket' => $request->desk,
        ]);
        return redirect()
        ->route('adm.keu.kode')
        ->with('success', 'Berhasil menambahkan kode praktikum');
    }
    public function editKodeKas($id)
    {
        $kode = KodeKas::find($id);
        return view('admin.keuangan.editKode', compact('kode'));
    }
    public function updateKodeKas(Request $request)
    {
        KodeKas::find($request->kode)->update([
            'nm_kode' => $request->nm_kode,
            'harga' => $request->harga,
            'ket' => $request->desk,
        ]);

        return redirect()
        ->route('adm.keu.kode')
        ->with('success', 'Berhasil mengubah kode praktikum');
    }
    public function deleteKodeKas(Request $request)
    {
        KodeKas::find($request->kode)->delete();

        return redirect()
        ->back()
        ->with('success', 'Berhasil menghapus kode praktikum');
    }
    public function indexKasPeriode()
    {
        $kas = KasPeriode::with('periode')->get();
        return view('admin.keuangan.indexKasPeriode', compact('kas'));
    }
    public function tambahKasPeriode()
    {
        $periode = Periode::all();
        return view('admin.keuangan.tambahKasPeriode', compact('periode'));
    }
    public function saveKasPeriode(Request $request)
    {
        KasPeriode::create([
            'id_periode' => $request->periode,
            'saldo_awal' => $request->saldo_awal,
            'sisa_saldo' => $request->saldo_awal,
            'ket' => $request->ket,
        ]);
        return redirect()
        ->route('adm.keu.kasp')
        ->with('success', 'Berhasil menambahkan kas periode');
    }
    public function editKasPeriode($id)
    {
        $kas = KasPeriode::find($id);
        $periode = Periode::all();
        return view('admin.keuangan.editKasPeriode', compact('kas', 'periode'));
    }
    public function updateKasPeriode(Request $request)
    {
        KasPeriode::find($request->kode_kasp)->update([
            'id_periode' => $request->periode,
            'saldo_awal' => $request->saldo_awal,
            'sisa_saldo' => $request->sisa_saldo,
            'ket' => $request->ket,
        ]);
        return redirect()
        ->route('adm.keu.kasp')
        ->with('success', 'Berhasil mengubah kas periode');
    }
    public function deleteKasPeriode(Request $request)
    {
        KasPeriode::find($request->kode_kasp)->delete();
        return redirect()
        ->back()
        ->with('success', 'Berhasil menghapus kas periode');
    }
    public function indexKas(Request $request)
    {
        $periode_id = $request->segment(3) ?? KasPeriode::max('id_kasp'); //ambil berdasarkan request
        $kas = Kas::where(['id_kasp' => $periode_id])->with('kode')->get();
        $kasp_all = KasPeriode::all();
        $kasp = KasPeriode::where(['id_periode' => $periode_id])->first();

        return view('admin.keuangan.indexKas', compact('kas', 'kasp_all', 'kasp', 'periode_id'));
    }
    public function tambahKas()
    {
        $kasp = KasPeriode::with('periode')->get();
        $kode = KodeKas::all();
        return view('admin.keuangan.tambahKas', compact('kasp', 'kode'));
    }
    public function detailKas($id)
    {
        $kas = Kas::where(['id_kas' => $id])->with('kode')->first();
        return view('admin.keuangan.detailKas', compact('kas'));
    }
    public function saveKas(Request $request)
    {
        $saldo = KasPeriode::find($request->kasp)->sisa_saldo;
        $total = $request->harga * $request->jumlah;
        if ($request->tipe == 'debit') $saldo += $total;
        else if ($request->tipe == 'kredit') $saldo -= $total;

        KasPeriode::find($request->kasp)->update(['sisa_saldo' => $saldo]);
        Kas::create([
            'id_kasp' => $request->kasp,
            'id_kode' => $request->kode_kas,
            'tgl' => $request->tgl,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'tipe' => $request->tipe,
            'total' => $total,
        ]);
        return redirect()
        ->route('adm.keu.kas')
        ->with('success', 'Berhasil menambahkan kas');
    }
    public function deleteKas(Request $request)
    {
        $pilih_kas = Kas::find($request->kode_kas);
        if ($pilih_kas)
        {
            $kembalikan_saldo = 0;
            $kasp_lama = KasPeriode::find($pilih_kas->id_kasp);
            if ($pilih_kas->tipe == 'debit')
            {
                $kembalikan_saldo = $kasp_lama->sisa_saldo - $pilih_kas->total;
                KasPeriode::find($pilih_kas->id_kasp)->update(['sisa_saldo' => $kembalikan_saldo]);
            }
            else if ($pilih_kas->tipe == 'kredit')
            {
                $kembalikan_saldo = $kasp_lama->sisa_saldo + $pilih_kas->total;
                KasPeriode::find($pilih_kas->id_kasp)->update(['sisa_saldo' => $kembalikan_saldo]);
            }
        }
        Kas::find($request->kode_kas)->delete();
        return redirect()
        ->back()
        ->with('success', 'Berhasil menghapus kas');
    }
    public function editKas($id)
    {
        $kasp = KasPeriode::with('periode')->get();
        $kode = KodeKas::all();
        $kas = Kas::where(['id_kas' => $id])->with('kode')->first();
        return view('admin.keuangan.editKas', compact('kasp', 'kode', 'kas'));
    }
    public function updateKas(Request $request)
    {
        $total = $request->harga * $request->jumlah;
        $pilih_kas = Kas::find($request->kode);
        if ($pilih_kas)
        {
            $kembalikan_saldo = 0;
            $kasp_lama = KasPeriode::find($pilih_kas->id_kasp);
            if ($pilih_kas->tipe == 'debit')
            {
                $kembalikan_saldo = $kasp_lama->sisa_saldo - $pilih_kas->total;
                KasPeriode::find($request->kasp)->update([
                    'sisa_saldo' => $kembalikan_saldo + $total,
                ]);
            }
            else if ($pilih_kas->tipe == 'kredit')
            {
                $kembalikan_saldo = $pilih_kas->sisa_saldo + $pilih_kas->total;
                KasPeriode::find($request->kasp)->update([
                    'sisa_saldo' => $kembalikan_saldo - $total,
                ]);
            }
        }

        if ($pilih_kas->tipe != $request->tipe)
        {
            $saldo = KasPeriode::find($request->kasp)->sisa_saldo;
            if ($request->tipe == 'debit') $saldo += $total;
            else if ($request->tipe == 'kredit') $saldo -= $total;

            KasPeriode::find($request->kasp)->update(['sisa_saldo' => $saldo]);
        }
        Kas::find($request->kode)->update([
            'id_kasp' => $request->kasp,
            'id_kode' => $request->kode_kas,
            'tgl' => $request->tgl,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'tipe' => $request->tipe,
            'total' => $total,
        ]);
        return redirect()
        ->route('adm.keu.kas')
        ->with('success', 'Berhasil mengubah kas');
    }

}
