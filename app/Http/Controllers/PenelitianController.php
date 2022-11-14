<?php

namespace App\Http\Controllers;

use App\Models\Penelitian\DaftarPercobaan;
use App\Models\Penelitian\Penelitian;
use App\Models\Penelitian\Permohonan;
use App\Models\Pengujian\Pengujian;
use App\Models\Pengujian\Percobaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PenelitianController extends Controller
{
    //user
    public function permohonan()
    {
        return view('penelitian.formPermohonan');
    }

    public function savePermohonan(Request $request)
    {
        $this->validate($request, [
            'proposal' => 'required',
            'surat' => 'required',
        ]);
        $path = 'public/files';
        $proposal = $request->file('proposal');
        $proposalName = $proposal->getClientOriginalName();
        $proposal->storeAs($path, $proposalName);
        $surat = $request->file('surat');
        $suratName = $surat->getClientOriginalName();
        $surat->storeAs($path, $suratName);

        Permohonan::create([
            'id_user' => auth()->user()->id_user,
            'tgl_permohonan' => Carbon::now(),
            'proposal' => "{$path}/{$proposalName}",
            'srt_permohonan' => "{$path}/{$suratName}",
            'status' => 'permohonan'
        ]);

        return redirect()->route('usr.listpermohonan');
    }

    public function listPermohonan()
    {
        $data = Permohonan::where('id_user', '=', auth()->user()->id_user)->get();
        return view('penelitian.permohonan', compact('data'));
    }

    public function formDaftarPenelitian($link=null)
    {
        if ($link == null) return abort(404);
        if (Permohonan::where([
                "link_formulir" => $link,
            ])->first() == null) abort(419);

        $pengujian_a = Pengujian::with(['pcb'])->where('nm_kategori', '=', 'BAHAN')->get();
        $pengujian_b = Pengujian::with(['pcb'])->where('nm_kategori', '=', 'PERKERASAN JALAN RAYA')->get();

        return view('penelitian.formPendaftaran', compact('pengujian_a', 'pengujian_b'));
    }
    public function daftarPenelitian(Request $request)
    {
        $this->validate($request, [
            'pengujian' => 'required'
        ]);

        $temp = Penelitian::create([
            'id_user' => auth()->user()->id_user,
            'tgl_daftar' => Carbon::now(),
            'dikirim_oleh' => $request->dikirim,
            'diterima_oleh' => $request->diterima,
        ]);
        foreach ($request->pengujian as $row)
        {
            DaftarPercobaan::create([
               'id_plt' => $temp->id_plt,
               'id_percobaan' => $row,
            ]);
        }
        return redirect()->route('usr.penelitian.kegiatan');
    }

    public function kegiatanPenelitian()
    {
        $kegiatan = Penelitian::where("id_user", '=', auth()->user()->id_user)->get();
        return view('penelitian.kegiatan', compact('kegiatan'));
    }

    public function detailKegiatanPenelitian(Penelitian $plt)
    {
        return view('penelitian.detailKegiatan', compact('plt'));
    }

    public function downloadLaporanHasil(Penelitian $laporan)
    {
        if ($laporan->laporan != null) {
            $file = storage_path("app/". $laporan->laporan);
            if (file_exists($file)) {
                return response()->download($file);
            }
        }
        return redirect()->back();
    }

    //admin
    public function daftarPermohonan()
    {
        $data = Permohonan::with(["user"])->get();
        return view('admin.penelitian.permohonan', compact('data'));
    }
    public function accPermohonan(Permohonan $pmh)
    {
        $link = base64_encode(Carbon::now());
        $pmh->update([
            'link_formulir' => $link,
            'status' => 'diterima',
        ]);
        return redirect()->back();
    }
    public function rejectPermohonan(Permohonan $pmh)
    {
        $pmh->update([
            'status' => 'ditolak',
        ]);
        return redirect()->back();
    }
    public function listPenelitian()
    {
        $data = Penelitian::withOnly(["user"])->get();
        return view('admin.penelitian.kegiatan', compact('data'));
    }
    public function detailPenelitian($plt=null)
    {
        if ($plt==null) abort(404);

        $detail = Penelitian::with(["user", "detail"])->find($plt);
        return view('admin.penelitian.detailKegiatan', compact('detail'));
    }
    public function updatePercobaanPenelitian(Request $request)
    {
        DaftarPercobaan::where([
            'id_plt' => $request->kode_plt,
            'id_percobaan' => $request->kode_pcb,
        ])->update([
            'jml_percobaan' => $request->jumlah,
            'total_biaya' => $request->total_biaya
        ]);
        $total = DaftarPercobaan::where("id_plt", '=', $request->kode_plt)->sum("total_biaya");
        Penelitian::find($request->kode_plt)->update([
            'total_bayar' => $total
        ]);
        return redirect()->back();
    }
    public function uploadLaporanHasil(Penelitian $laporan, Request $request)
    {
        $this->validate($request, [
            'laporan' => 'required'
        ]);
        if ($laporan->laporan != null) {
            Storage::delete($laporan->laporan);
        }
        $path = 'public/files/laporan';
        $laporanFile = $request->file('laporan');
        $laporanName = $laporanFile->getClientOriginalName();
        $laporanFile->storeAs($path, $laporanName);
        $laporan->update([
           'laporan' => "{$path}/{$laporanName}"
        ]);

        return redirect()->back();
    }


    public function indexPengujian()
    {
        $pengujian = Pengujian::all();
        return view('admin.penelitian.masterdata.indexPengujian', compact('pengujian'));
    }
    public function savePengujian(Request $request)
    {
        Pengujian::create([
            'nm_kategori' => $request->kategori,
            'nm_pengujian' => $request->pgj,
        ]);
        return redirect()->back();
    }
    public function updatePengujian(Request $request)
    {
        Pengujian::find($request->kode_pgj)->update([
            'nm_kategori' => $request->kategori,
            'nm_pengujian' => $request->pgj,
        ]);
        return redirect()->back();
    }
    public function deletePengujian(Pengujian $pgj)
    {
        $pgj->delete();
        return redirect()->back();
    }
    public function indexPercobaan()
    {
        $pengujian = Pengujian::get();
        $percobaan = Percobaan::with("pgj")->get();
        return view('admin.penelitian.masterdata.indexPercobaan',
            compact('percobaan', 'pengujian'));
    }
    public function savePercobaan(Request $request)
    {
        Percobaan::create([
            'id_pgj' => $request->pgj,
            'nm_percobaan' => $request->pcb
        ]);
        return redirect()->back();
    }
    public function updatePercobaan(Request $request)
    {
        Percobaan::find($request->kode_pcb)->update([
            'id_pgj' => $request->pgj,
            'nm_percobaan' => $request->pcb
        ]);
        return redirect()->back();
    }
    public function deletePercobaan(Percobaan $pcb)
    {
        $pcb->delete();
        return redirect()->back();
    }

}
