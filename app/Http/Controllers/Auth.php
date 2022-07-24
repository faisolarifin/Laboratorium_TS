<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    AkunMhs,
    Admin,
};

class Auth extends Controller
{  
    public function dashboardAdmin()
    {
        return view('admin.index');
    }
    public function dashboardMhs()
    {
        return view('index');
    }
    public function loginFormMahasiswa()
    {
        return view('auth.loginMhs');
    }
    public function loginAkunMahasiswa(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|numeric',
            'password' => 'required',
        ]);

        $LOGIN = AkunMhs::where([
            'nim' => $request->nim,
            'password' => $request->password,
            ])->first();
            if ($LOGIN !== NULL) {
                if ($LOGIN->status == 'block') return redirect()->back()->with('error', 'Akun anda di block. Hubungi Admin!');
                session()->put('id', $LOGIN->id_mhs);
                session()->put('nama', $LOGIN->nama);
                session()->put('foto', $LOGIN->foto);
                session()->put('role', 'MHS');
                return redirect()->route('mhs.dashboard');
            }
        return redirect()->route('auth.loginmhs')->with('error', 'Username atau Password anda salah!');
    }
        
    public function loginFormAdmin()
    {
        return view('auth.loginAdmin');
    }

    public function loginAkunAdmin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $LOGIN = Admin::where([
            'username' => $request->username,
            'password' => $request->password,
            ])->first();
            if ($LOGIN !== NULL) {
                $request->session()->put('id', $LOGIN->id);
                $request->session()->put('nama', $LOGIN->nama);
                $request->session()->put('role', 'ADMIN');
                return redirect()->route('adm.dashboard');
            }
        return redirect()->route('auth.loginadmin')->with('error', 'Username atau Password anda salah!');
    }

    public function registerFormMahasiswa()
    {
        return view('auth.registerMhs');
    }

    public function registerAkunMahasiswa(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|numeric|digits:9|unique:App\Models\AkunMhs,nim',
            'password' => 'required|min:8',
            'konfirmasi' => 'required|same:password',
        ]);

        AkunMhs::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'password' => $request->password,
            'foto' => 'default.png',
            'status' => 'non-aktif',
        ]);

        return redirect()->route('auth.loginmhs');    
    }

    public function profileFormMahasiswa(Request $request)
    {
        $mhs = AkunMhs::find($request->session()->get('id'));
        return view('auth.profileMhs', compact('mhs'));
    }

    public function saveProfileMahasiswa(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|numeric|digits:9',
            'alamat' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'numeric',
            'email' => 'email',
            'foto' => 'required',
        ]);

        $path = $request->file('foto')->store('public/foto');

        AkunMhs::find($request->session()->get('id'))->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'foto' => $path,
            'status' => 'aktif',
        ]);

        return redirect()->route('mhs.listmatkum');
        
    }

    public function logout(Request $request)
    {
        $request->session()->remove('id');
        $request->session()->remove('nama');

        return redirect()->route('auth.loginmhs');
    }
}
