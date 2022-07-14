<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminExport,
    AdminKeuangan,
    AdminMaster,
    MhsPraktikum,
    AdminPraktikum,
    AdminSetting,
    Auth,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['cekmhs'])->group(function() {
    Route::get('/matkum', [MhsPraktikum::class, 'listMatkulPraktikum'])->name('mhs.listmatkum');
    Route::get('/listdaftar', [MhsPraktikum::class, 'listPendingDaftar'])->name('mhs.rencana');
    Route::post('/matkum', [MhsPraktikum::class, 'addMatkulPraktikum'])->name('mhs.matkum');
    Route::delete('/matkum', [MhsPraktikum::class, 'hapusMatkulPraktikum'])->name('mhs.matkum');
    Route::get('/kelompok', [MhsPraktikum::class, 'listAnggotaPraktikum'])->name('mhs.kel');
    Route::get('/kelompok/{id}', [MhsPraktikum::class, 'listAnggotaPraktikum'])->name('mhs.kelompok');
    Route::get('/jadwal', [MhsPraktikum::class, 'listJadwalPraktikum'])->name('mhs.jad');
    Route::get('/jadwal/{id}', [MhsPraktikum::class, 'listJadwalPraktikum'])->name('mhs.jadwal');
    Route::get('/nilai', [MhsPraktikum::class, 'nilaiPraktikum'])->name('mhs.nilai');
});

Route::middleware(['cekadmin'])->group(function() {
    Route::prefix('prak')->group(function() {
        Route::get('/', [AdminPraktikum::class, 'listPendaftarPraktikum']);
        Route::get('/listdaftar', [AdminPraktikum::class, 'listPendaftarPraktikum'])->name('adm.prak.pendaftar');
        Route::get('/listdaftar/{id}', [AdminPraktikum::class, 'listPendaftarPraktikumById'])->name('adm.prak.listdaftar');
        Route::post('/bayar', [AdminPraktikum::class, 'accBayarPraktikum'])->name('adm.prak.bayar');
        Route::post('/terima', [AdminPraktikum::class, 'accTerimaPraktikum'])->name('adm.prak.accfix');
        Route::get('/daftaracc', [AdminPraktikum::class, 'listPerdaftarPerMatkum'])->name('adm.prak.acc');
        Route::get('/daftaracc/{id}', [AdminPraktikum::class, 'listPerdaftarPerMatkum'])->name('adm.prak.daftaracc');
        Route::post('/daftaracc', [AdminPraktikum::class, 'generateKelompokPraktikum'])->name('adm.prak.generate');
        Route::get('/kelompok', [AdminPraktikum::class, 'kelompokPerdaftarPerMatkum'])->name('adm.prak.kel');
        Route::put('/nilai', [AdminPraktikum::class, 'updateNilaiPraktikum'])->name('adm.prak.nilai');
        Route::put('/kelompok', [AdminPraktikum::class, 'updateKelompokPraktikum'])->name('adm.prak.kel');
        Route::get('/kelompok/{id}', [AdminPraktikum::class, 'kelompokPerdaftarPerMatkum'])->name('adm.prak.kelompok');
        Route::get('/anggota/{id}', [AdminPraktikum::class, 'anggotaKelompokPraktikum'])->name('adm.prak.anggota');
        Route::delete('/kelompok', [AdminPraktikum::class, 'hapusKelompokPraktikum'])->name('adm.prak.hpskelompok');
        Route::get('/history', [AdminPraktikum::class, 'historyPraktikum'])->name('adm.prak.hist');
        Route::get('/history/{id}', [AdminPraktikum::class, 'historyPraktikum'])->name('adm.prak.history');
        Route::get('/jadwal/{id}', [AdminPraktikum::class, 'jadwalKelompokPraktikum'])->name('adm.prak.jadwal');
        Route::get('/jadwal', function() {return redirect()->back();});
        Route::post('/jadwal', [AdminPraktikum::class, 'saveJadwalPraktikum'])->name('adm.prak.tmbjadwal');
        Route::delete('/jadwal', [AdminPraktikum::class, 'hapusJadwalPraktikum'])->name('adm.prak.hpsjadwal');
    });

    Route::prefix('keu')->group(function(){
        //kode kas
        Route::get('/kode', [AdminKeuangan::class, 'indexKodeKas'])->name('adm.keu.kode');
        Route::get('/kode/tambah', [AdminKeuangan::class, 'tambahKodeKas'])->name('adm.keu.fkode');
        Route::get('/kode/{id}', [AdminKeuangan::class, 'editKodeKas'])->name('adm.keu.ekode');
        Route::post('/kode', [AdminKeuangan::class, 'saveKodeKas'])->name('adm.keu.skode');
        Route::put('/kode', [AdminKeuangan::class, 'updateKodeKas'])->name('adm.keu.ukode');
        Route::delete('/kode', [AdminKeuangan::class, 'deleteKodeKas'])->name('adm.keu.dkode');
        //kas periode
        Route::get('/kasp', [AdminKeuangan::class, 'indexKasPeriode'])->name('adm.keu.kasp');
        Route::get('/kasp/tambah', [AdminKeuangan::class, 'tambahKasPeriode'])->name('adm.keu.fkasp');
        Route::get('/kasp/{id}', [AdminKeuangan::class, 'editKasPeriode'])->name('adm.keu.ekasp');
        Route::post('/kasp', [AdminKeuangan::class, 'saveKasPeriode'])->name('adm.keu.skasp');
        Route::put('/kasp', [AdminKeuangan::class, 'updateKasPeriode'])->name('adm.keu.ukasp');
        Route::delete('/kasp', [AdminKeuangan::class, 'deleteKasPeriode'])->name('adm.keu.dkasp');
        //administrasi kas
        Route::get('/kas', [AdminKeuangan::class, 'indexKas'])->name('adm.keu.kas');
        Route::get('/kas/tambah', [AdminKeuangan::class, 'tambahKas'])->name('adm.keu.fkas');
        Route::get('/kas/{id}', [AdminKeuangan::class, 'editKas'])->name('adm.keu.ekas');
        Route::post('/kas', [AdminKeuangan::class, 'saveKas'])->name('adm.keu.skas');
        Route::post('/kas/{id}', [AdminKeuangan::class, 'detailKas'])->name('adm.keu.dtkas');
        Route::put('/kas', [AdminKeuangan::class, 'updateKas'])->name('adm.keu.ukas');
        Route::delete('/kas', [AdminKeuangan::class, 'deleteKas'])->name('adm.keu.dkas');

    });
    
    Route::prefix('master')->group(function() {
        Route::get('/', [AdminMaster::class, 'indexDataMahasiswa']);
        Route::get('/mhs', [AdminMaster::class, 'indexDataMahasiswa'])->name('adm.master.mhs');
        Route::put('/mhs', [AdminMaster::class, 'resetMahasiswa'])->name('adm.master.resetmhs');
        Route::put('/mhs/block', [AdminMaster::class, 'blockMahasiswa'])->name('adm.master.blockmhs');
        //dosen
        Route::get('/dosen', [AdminMaster::class, 'indexDataDosen'])->name('adm.master.dsn');
        Route::get('/dosen/tambah', [AdminMaster::class, 'tambahDataDosen'])->name('adm.master.fdsn');
        Route::get('/dosen/{id}', [AdminMaster::class, 'editDataDosen'])->name('adm.master.edsn');
        Route::post('/dosen', [AdminMaster::class, 'saveDataDosen'])->name('adm.master.sdsn');
        Route::put('/dosen', [AdminMaster::class, 'updateDataDosen'])->name('adm.master.udsn');
        Route::delete('/dosen', [AdminMaster::class, 'deleteDataDosen'])->name('adm.master.ddsn');
        //matkum
        Route::get('/matkum', [AdminMaster::class, 'indexDataMatkum'])->name('adm.master.matkum');
        Route::get('/matkum/tambah', [AdminMaster::class, 'tambahDataMatkum'])->name('adm.master.fmatkum');
        Route::get('/matkum/{id}', [AdminMaster::class, 'editDataMatkum'])->name('adm.master.ematkum');
        Route::post('/matkum', [AdminMaster::class, 'saveDataMatkum'])->name('adm.master.smatkum');
        Route::put('/matkum', [AdminMaster::class, 'updateDataMatkum'])->name('adm.master.umatkum');
        Route::delete('/matkum', [AdminMaster::class, 'deleteDataMatkum'])->name('adm.master.dmatkum');
        //periode
        Route::get('/periode', [AdminMaster::class, 'indexDataPeriode'])->name('adm.master.periode');
        Route::get('/periode/tambah', [AdminMaster::class, 'tambahDataPeriode'])->name('adm.master.fperiode');
        Route::get('/periode/{id}', [AdminMaster::class, 'editDataPeriode'])->name('adm.master.eperiode');
        Route::post('/periode', [AdminMaster::class, 'saveDataPeriode'])->name('adm.master.speriode');
        Route::put('/periode', [AdminMaster::class, 'updateDataPeriode'])->name('adm.master.uperiode');
    });

    Route::prefix('export')->group(function() {
        Route::post('/daftarhadir', [AdminExport::class, 'exportDaftarHadir'])->name('adm.export.jadwal');
        Route::post('/daftarujian', [AdminExport::class, 'exportDafdirPerMatkum'])->name('adm.export.dafdir');
        Route::post('/ba', [AdminExport::class, 'exportBAPelaksanaanPerMatkum'])->name('adm.export.ba');
        Route::post('/baujian', [AdminExport::class, 'exportBAUjianPerMatkum'])->name('adm.export.baujian');
        Route::post('/sertif', [AdminExport::class, 'exportSertifikat'])->name('adm.export.sertif');
        Route::post('/dafdirdosen', [AdminExport::class, 'exportDafdirPenguji'])->name('adm.export.dafdirdosen');
    });

    Route::prefix('setting')->group(function() {
        Route::get('/', [AdminSetting::class, 'index'])->name('adm.setting');
        Route::put('/', [AdminSetting::class, 'updateSetting'])->name('adm.setting');
    });
    
});

Route::get('/', [Auth::class, 'loginFormMahasiswa'])->name('auth.loginmhs');
Route::post('/', [Auth::class, 'loginAkunMahasiswa'])->name('auth.loginmhs');
Route::get('/register', [Auth::class, 'registerFormMahasiswa'])->name('auth.regmhs');
Route::post('/register', [Auth::class, 'registerAkunMahasiswa'])->name('auth.regmhs');
Route::get('/profile', [Auth::class, 'profileFormMahasiswa'])->name('mhs.profile');
Route::post('/profile', [Auth::class, 'saveProfileMahasiswa'])->name('mhs.profile');
Route::get('/auth', [Auth::class, 'loginFormAdmin'])->name('auth.loginadmin');
Route::post('/auth', [Auth::class, 'loginAkunAdmin'])->name('auth.loginadmin');
Route::get('/logout', [Auth::class, 'logout'])->name('auth.logout');


Route::get('/createperiode', [AdminPraktikum::class, 'createPeriode']);


