<?php

namespace App\Http\Controllers;

use App\Models\{Admin, Periode, Setting, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function updatePasswordView()
    {
        return view('admin.setting.updatePassword');
    }
    public function saveUpdatePassword(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::attempt([
            'username' => auth()->user()->username,
            'password' => $request->last_pwd
        ])) {
            if ($request->new_pwd <> $request->confirm_pwd) return redirect()->back()->with('error', 'password konfirmasi tidak sama!');
            User::find(auth()->user()->id_user)->update([
                'password' => Hash::make($request->new_pwd)
            ]);
            return redirect()->back()->with('success', 'Berhasil update password!');
        }
        return redirect()->back()->with('error', 'Password lama tidak benar!');
    }
}
