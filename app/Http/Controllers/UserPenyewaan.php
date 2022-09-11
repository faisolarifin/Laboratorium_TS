<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan\Alat;
use App\Models\Penyewaan\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserPenyewaan extends Controller
{
    public function daftarAlat()
    {
        $alat = Alat::all();
        return view('sewa.listAlat', compact('alat'));
    }
    public function daftarPenyewaan()
    {
        $listsewa = Sewa::whereRelation("user", [
            'id_user' => auth()->user()->id_user,
        ])->with(['alat'])->where('status', '<>', 'selesai')->orderBy('id_sewa', 'desc')->get();
        return view('sewa.penyewaan', compact('listsewa'));
    }
    public function historyPenyewaan()
    {
        $fixsewa = Sewa::whereRelation("user", [
            'id_user' => auth()->user()->id_user,
        ])->with(['alat'])->where('status', '=', 'selesai')->get();
        return view('sewa.history', compact('fixsewa'));
    }
    public function formPenyewaan()
    {
        $alat = Alat::all();
        return view('sewa.formPenyewaan', compact('alat'));
    }
    public function cancelSewa()
    {
        $sewa = Sewa::find(request()->kode_sewa);
        if($sewa->status == "permohonan") {
            $sewa->delete();
            return redirect()
                ->back()
                ->with('success', 'Berhasil membatalkan penyewaan');
        }
        return redirect()
            ->back()
            ->with('error', 'Gagal membatalkan penyewaan');
    }
    public function permohonanSewa()
    {
        $user_id = auth()->user()->id_user;
        $alat = Alat::find(request()->alat);
        $jumlah = $alat->jumlah - request()->jumlah;
        if ($jumlah < 0) {
            return redirect()
                ->back()
                ->with('error', 'Jumlah ketersedian alat tidak mencukupi untuk disewa!');
        }
        Sewa::create([
            'id_user' => $user_id,
            'id_alat' => request()->alat,
            'tgl_permohonan' => Carbon::now(),
            'jumlah' => request()->jumlah,
            'status' => 'permohonan',
        ]);
        return redirect()
            ->route('usr.sewa.r')
            ->with('success', 'Berhasil melakukan permohonan penyewaan alat');
    }

}
