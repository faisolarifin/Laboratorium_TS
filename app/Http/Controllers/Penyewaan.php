<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan\Alat;
use App\Models\Penyewaan\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\SewaExport;

class Penyewaan extends Controller
{
    public function indexAlat()
    {
        $alat = Alat::all();
        return view('admin.sewa.daftarAlat', compact('alat'));
    }
    public function tambahAlat()
    {
        return view('admin.sewa.tambahAlat');
    }
    public function editAlat($id)
    {
        $alat = Alat::find($id);
        return view('admin.sewa.editAlat', compact('alat'));
    }
    public function saveAlat(Request $request)
    {
        Alat::create([
            'nm_alat' => $request->nm_alat,
            'biaya_umum' => $request->biaya_umum,
            'biaya_khusus' => $request->biaya_khusus,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()
            ->route('adm.sewa.alat.i')
            ->with('success', 'Berhasil menambahkan data alat');
    }
    public function updateAlat(Request $request)
    {
        Alat::find($request->kode_alat)->update([
            'nm_alat' => $request->nm_alat,
            'biaya_umum' => $request->biaya_umum,
            'biaya_khusus' => $request->biaya_khusus,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()
            ->route('adm.sewa.alat.i')
            ->with('success', 'Berhasil mengubah data alat');
    }
    public function deleteAlat(Request $request)
    {
        Alat::find($request->kode_alat)->delete();

        return redirect()
            ->back()
            ->with('success', 'Berhasil menghapus data alat');
    }

    public function indexPenyewaan()
    {
        $penyewa = Sewa::with(['user','alat'])->orderBy('id_sewa', 'desc')->get();
        return view('admin.sewa.penyewaan', compact('penyewa'));
    }
    public function startSewa()
    {
        $sewa = Sewa::find(request()->kode_sewa);
        $alat = Alat::find($sewa->id_alat);

        $jumlah = $alat->jumlah - $sewa->jumlah;
        if ($jumlah < 0) {
            return redirect()
                ->back()
                ->with('error', 'Jumlah ketersedian alat tidak mencukupi untuk disewa!');
        }
        $alat->update([
            'jumlah' => $jumlah,
        ]);
        $sewa->update([
            'tgl_sewa' => Carbon::now(),
            'status' => 'sewa',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Penyewaan alat berhasil dilakukan');
    }
    public function stopSewa()
    {
        $sewa  = Sewa::with(['alat','user'])->find(request()->kode_sewa);
        $diff  = time() - strtotime($sewa->tgl_sewa);
        $hari  = (int) floor($diff / (60 * 60 * 24)) || 1;
        $biaya = $sewa->user->role == 'umum' ? $sewa->alat->biaya_umum : $sewa->alat->biaya_khusus;
        $total = $biaya * $hari * $sewa->jumlah;

        $jumlah = $sewa->alat->jumlah + $sewa->jumlah;
        Alat::find($sewa->id_alat)->update([
            'jumlah' => $jumlah,
        ]);
        Sewa::find(request()->kode_sewa)->update([
            'tgl_kembali' => Carbon::now(),
            'total_biaya' => $total,
            'status' => 'selesai',
        ]);
        return redirect()
            ->back()
            ->with('success', 'Penyewaan alat berhasil dilakukan');
    }
    public function exportBAP()
    {
        return SewaExport::exportBAPeminjaman();
    }
    public function exportBP()
    {
        return SewaExport::exportBuktiPeminjaman();
    }
    public function exportSBT()
    {
        return SewaExport::exportBuktiBebasPinjam();
    }

}
