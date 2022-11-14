<?php

namespace App\Exports;

use App\Helpers\Date;
use App\Models\Penyewaan\Sewa;
use App\Models\Setting;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

class SewaExport
{
    public static function exportBAPeminjaman()
    {
        $row = Sewa::with(['user','alat'])->find(request()->kode_sewa);
        $template_document = new TemplateProcessor(storage_path('word/sewa/BA_Peminjaman.docx'));

        $template_document->setValue('nama', strtoupper($row->user->nama));
        $template_document->setValue('alamat', $row->user->alamat);
        $template_document->setValue('hari', Date::hariIni($row->tgl_sewa));
        $template_document->setValue('tanggal', Date::tglIndo($row->tgl_sewa));
        $template_document->setValue('jumlah', $row->jumlah);
        $template_document->setValue('alat', $row->alat->nm_alat);
        $template_document->setValue('tglbawah', Date::tglIndo(Carbon::now()->format('Y-m-d')));
        $template_document->setValue('kalab', Setting::find(1)->kalab);

        $filename = "Berita_Acara_Peminjaman.docx";
        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }
    public static function exportBuktiBebasPinjam()
    {
        $row = Sewa::with(['user','alat'])->find(request()->kode_sewa);
        $template_document = new TemplateProcessor(storage_path('word/sewa/Bukti_Bebas_Pinjam.docx'));

        $template_document->setValue('nama', strtoupper($row->user->nama));
        $template_document->setValue('barang', $row->alat->nm_alat);
        $template_document->setValue('kondisi', $row->alat->kondisi);
        $template_document->setValue('jumlah', $row->jumlah);
        $template_document->setValue('tglbawah', Date::tglReverse(Carbon::now()->format('Y-m-d')));

        $filename = "Bukti_Bebas_Peminjaman.docx";
        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }
    public static function exportBuktiPeminjaman()
    {
        $row = Sewa::with(['user','alat'])->find(request()->kode_sewa);
        $template_document = new TemplateProcessor(storage_path('word/sewa/Bukti_Peminjaman.docx'));

        $template_document->setValue('nama', strtoupper($row->user->nama));
        $template_document->setValue('alamat', $row->user->alamat);
        $template_document->setValue('alat', $row->alat->nm_alat);
        $template_document->setValue('kondisi', $row->alat->kondisi);
        $template_document->setValue('jumlah',  $row->jumlah);
        $template_document->setValue('tglpjm', Date::tglReverse($row->tgl_sewa));
        $template_document->setValue('tglbawah', Date::tglReverse(Carbon::now()->format('Y-m-d')));

        $filename = "Bukti_Peminjaman.docx";
        $template_document->saveAs(storage_path('word/').$filename);

        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('word/').$filename);
        unlink(storage_path('word/').$filename);
    }
}
