<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{AkunMhs, Admin, User};
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Auth as Auntentikasi;
use Illuminate\Support\Facades\Session;

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
    public function loginFormUser()
    {
        return view('auth.loginUser');
    }
    public function loginAkunUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|numeric',
            'password' => 'required',
        ]);
        if (Auntentikasi::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            if (auth()->user()->status == 'block') return redirect()->back()->with('error', 'Akun anda di block. Hubungi Admin!');
            if (auth()->user()->role == 'admin') return redirect()->back();

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

        if (Auntentikasi::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('adm.dashboard');
            }
        }
        return redirect()->route('auth.loginadmin')->with('error', 'Username atau Password anda salah!');
    }

    public function registerFormUser()
    {
        return view('auth.registerUser');
    }

    public function registerAkunUser(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required|numeric|unique:App\Models\User,username',
            'role' => 'required|in:mahasiswa,dosen,umum',
            'password' => 'required|min:8',
            'konfirmasi' => 'required|same:password',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'foto' => 'public/foto/default.png',
            'role' => $request->role,
            'status' => 'non-aktif',
        ]);

        return redirect()->route('auth.loginmhs');
    }

    public function profileFormUser(Request $request)
    {
        $mhs = User::find(auth()->user()->id_user);
        return view('auth.profileUser', compact('mhs'));
    }

    public function saveProfileUser(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required|numeric',
            'alamat' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'numeric',
            'email' => 'email',
            'foto' => 'required',
        ]);

        $path = $request->file('foto')->store('public/foto');

        User::find(auth()->user()->id_user)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'foto' => $path,
            'status' => 'aktif',
        ]);

        return redirect()->route('mhs.dashboard');

    }
    public function updatePasswordView()
    {
        return view('auth.updatePassword');
    }
    public function updatePassword(Request $request)
    {
        if (Auntentikasi::attempt([
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
    public function logout()
    {
        Session::flush();
        Auntentikasi::logout();
        return redirect()->route('auth.loginmhs');
    }
}
