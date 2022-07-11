<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSetting extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        $periode = Periode::all();
        return view('admin.setting.indexSetting', compact('setting', 'periode'));
    }
    public function updateSetting(Request $request)
    {
        Setting::find(1)->update([
            'value' => $request->dekan
        ]);
        Setting::find(2)->update([
            'value' => $request->periode
        ]);
        Setting::find(3)->update([
            'value' => $request->kalab
        ]);
        return redirect()->back()->with('success', 'Pengaturan telah diubah');
    }
}
