<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSetting extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $periode = Periode::all();
        return view('admin.setting.indexSetting', compact('setting', 'periode'));
    }
    public function updateSetting(Request $request)
    {    
        Setting::find(1)->update([
            'dekan' => $request->dekan,
            'kaprodi' => $request->kaprodi,
            'kalab' => $request->kalab,
            'periode_aktif' => $request->periode,
            'praktikum' => ($request->sw_prak == 'on') ? 'on' : 'off',
        ]);

        return redirect()->back()->with('success', 'Pengaturan telah diubah');
    }
}
