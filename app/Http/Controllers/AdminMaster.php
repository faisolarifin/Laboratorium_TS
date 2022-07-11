<?php

namespace App\Http\Controllers;

use App\Models\AkunMhs;
use App\Models\Dosen;
use App\Models\MatkulPraktikum;
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
    
}
