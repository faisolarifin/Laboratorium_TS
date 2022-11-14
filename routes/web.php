<?php

use App\Http\Controllers\{AdminInventaris,
    AdminKeuangan,
    AdminMaster,
    AdminPraktikum,
    AdminSetting,
    Auth,
    MhsPraktikum,
    Penyewaan,
    UserPenyewaan,
    PenelitianController};
use Illuminate\Support\Facades\Route;

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

Route::middleware(['cekuser'])->group(function() {
    Route::get('/dash', [Auth::class, 'dashboardMhs'])->name('mhs.dashboard');
    Route::get('/matkum', [MhsPraktikum::class, 'listMatkulPraktikum'])->name('mhs.listmatkum');
    Route::get('/listdaftar', [MhsPraktikum::class, 'listPendingDaftar'])->name('mhs.rencana');
    Route::post('/matkum', [MhsPraktikum::class, 'addMatkulPraktikum'])->name('mhs.matkum');
    Route::delete('/matkum', [MhsPraktikum::class, 'hapusMatkulPraktikum'])->name('mhs.matkum');
    Route::get('/kelompok', [MhsPraktikum::class, 'listAnggotaPraktikum'])->name('mhs.kel');
    Route::get('/kelompok/{id}', [MhsPraktikum::class, 'listAnggotaPraktikum'])->name('mhs.kelompok');
    Route::get('/jadwal', [MhsPraktikum::class, 'listJadwalPraktikum'])->name('mhs.jad');
    Route::get('/jadwal/{id}', [MhsPraktikum::class, 'listJadwalPraktikum'])->name('mhs.jadwal');
    Route::get('/nilai', [MhsPraktikum::class, 'nilaiPraktikum'])->name('mhs.nilai');

    Route::get('/alat', [UserPenyewaan::class, 'daftarAlat'])->name('usr.alat');
    Route::get('/daftarsewa', [UserPenyewaan::class, 'daftarPenyewaan'])->name('usr.sewa.r');
    Route::get('/historysewa', [UserPenyewaan::class, 'historyPenyewaan'])->name('usr.sewa.h');
    Route::delete('/cancelsewa', [UserPenyewaan::class, 'cancelSewa'])->name('usr.sewa.c');
    Route::get('/formsewa', [UserPenyewaan::class, 'formPenyewaan'])->name('usr.sewa.f');
    Route::post('/sewa', [UserPenyewaan::class, 'permohonanSewa'])->name('usr.sewa');

    Route::get('/penelitian', [PenelitianController::class, 'permohonan'])->name('usr.permohonan');
    Route::post('/penelitian', [PenelitianController::class, 'savePermohonan'])->name('usr.permohonan.s');
    Route::get('/penelitian/permohonan', [PenelitianController::class, 'listPermohonan'])->name('usr.listpermohonan');
    Route::get('/penelitian/daftar/{link?}', [PenelitianController::class, 'formDaftarPenelitian'])->name('usr.penelitian.form');
    Route::post('/penelitian/daftar', [PenelitianController::class, 'daftarPenelitian'])->name('usr.penelitian.daftar');
    Route::get('/penelitian/kegiatan', [PenelitianController::class, 'kegiatanPenelitian'])->name('usr.penelitian.kegiatan');
    Route::get('/penelitian/kegiatan/{plt?}', [PenelitianController::class, 'detailKegiatanPenelitian'])->name('usr.penelitian.detail');
    Route::get('/penelitian/laporan/{laporan?}', [PenelitianController::class, 'downloadLaporanHasil'])->name('usr.laporan.download');

});

Route::middleware(['cekadmin'])->group(function() {
    Route::get('/dashboard', [Auth::class, 'dashboardAdmin'])->name('adm.dashboard');

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

        //export word
        Route::post('/daftarhadir', [AdminPraktikum::class, 'exportDaftarHadir'])->name('adm.export.jadwal');
        Route::post('/daftarujian', [AdminPraktikum::class, 'exportDafdirPerMatkum'])->name('adm.export.dafdir');
        Route::post('/ba', [AdminPraktikum::class, 'exportBAPelaksanaan'])->name('adm.export.ba');
        Route::post('/baujian', [AdminPraktikum::class, 'exportBAUjian'])->name('adm.export.baujian');
        Route::post('/sertif', [AdminPraktikum::class, 'exportSertifikat'])->name('adm.export.sertif');
        Route::post('/dafdirdosen', [AdminPraktikum::class, 'exportDafdirPenguji'])->name('adm.export.dafdirdosen');
        Route::post('/penjadwalan', [AdminPraktikum::class, 'exportPenjadwalan'])->name('adm.export.penjadwalan');
    });

    Route::prefix('sewa')->group(function(){
        //alat
        Route::get('alat', [Penyewaan::class, 'indexAlat'])->name('adm.sewa.alat.i');
        Route::get('/alat/tambah', [Penyewaan::class, 'tambahAlat'])->name('adm.sewa.alat.t');
        Route::get('/alat/{id}', [Penyewaan::class, 'editAlat'])->name('adm.sewa.alat.e');
        Route::post('/alat', [Penyewaan::class, 'saveAlat'])->name('adm.sewa.alat.s');
        Route::put('/alat', [Penyewaan::class, 'updateAlat'])->name('adm.sewa.alat.u');
        Route::delete('/alat', [Penyewaan::class, 'deleteAlat'])->name('adm.sewa.alat.d');

        //
        Route::get('/', [Penyewaan::class, 'indexPenyewaan'])->name('adm.sewa.i');
        Route::post('/start', [Penyewaan::class, 'startSewa'])->name('adm.sewa.st');
        Route::post('/finish', [Penyewaan::class, 'stopSewa'])->name('adm.sewa.fs');
        //export
        Route::post('/bap', [Penyewaan::class, 'exportBAP'])->name('adm.sewa.export.bap');
        Route::post('/bp', [Penyewaan::class, 'exportBP'])->name('adm.sewa.export.bp');
        Route::post('/sbt', [Penyewaan::class, 'exportSBT'])->name('adm.sewa.export.sbt');

    });

    Route::prefix('plt')->group(function () {
        Route::get('/permohonan', [PenelitianController::class, 'daftarPermohonan'])->name('adm.plt.permohonan');
        Route::get('/permohonan/acc/{pmh?}', [PenelitianController::class, 'accPermohonan'])->name('adm.permohonan.acc');
        Route::get('/permohonan/reject/{pmh?}', [PenelitianController::class, 'rejectPermohonan'])->name('adm.permohonan.reject');

        Route::get('/penelitian', [PenelitianController::class, 'listPenelitian'])->name('adm.plt.penelitian');
        Route::get('/penelitian/{plt?}', [PenelitianController::class, 'detailPenelitian'])->name('adm.plt.detail');

        Route::put('/penelitian/percobaan', [PenelitianController::class,'updatePercobaanPenelitian'])->name('adm.plt.percobaan');
        Route::put('/penelitian/laporan/{laporan}', [PenelitianController::class,'uploadLaporanHasil'])->name('adm.plt.laporan');

        Route::get('/master/pengujian', [PenelitianController::class, 'indexPengujian'])->name('adm.plt.pengujian.index');
        Route::post('/master/pengujian', [PenelitianController::class, 'savePengujian'])->name('adm.plt.pengujian.save');
        Route::put('/master/pengujian', [PenelitianController::class, 'updatePengujian'])->name('adm.plt.pengujian.update');
        Route::delete('/master/pengujian/{pgj}', [PenelitianController::class, 'deletePengujian'])->name('adm.plt.pengujian.delete');

        Route::get('/master/percobaan', [PenelitianController::class, 'indexPercobaan'])->name('adm.plt.percobaan.index');
        Route::post('/master/percobaan', [PenelitianController::class, 'savePercobaan'])->name('adm.plt.percobaan.save');
        Route::put('/master/percobaan', [PenelitianController::class, 'updatePercobaan'])->name('adm.plt.percobaan.update');
        Route::delete('/master/percobaan/{pcb}', [PenelitianController::class, 'deletePercobaan'])->name('adm.plt.percobaan.delete');

    });

    Route::prefix('inv')->group(function(){
        Route::get('/permohon', [AdminInventaris::class, 'indexDataPermohon'])->name('adm.inv.permohon');
        Route::get('/permohon/tambah', [AdminInventaris::class, 'tambahDataPermohon'])->name('adm.inv.permohon.t');
        Route::get('/permohon/{id}', [AdminInventaris::class, 'editDataPermohon'])->name('adm.inv.permohon.e');
        Route::post('/permohon', [AdminInventaris::class, 'saveDataPermohon'])->name('adm.inv.permohon.s');
        Route::put('/permohon', [AdminInventaris::class, 'updateDataPermohon'])->name('adm.inv.permohon.u');
        Route::delete('/permohon', [AdminInventaris::class, 'deleteDataPermohon'])->name('adm.inv.permohon.d');

        Route::get('/bahan', [AdminInventaris::class, 'indexDataBahan'])->name('adm.inv.bahan');
        Route::get('/bahan/tambah', [AdminInventaris::class, 'tambahDataBahan'])->name('adm.inv.bahan.t');
        Route::get('/bahan/{id}', [AdminInventaris::class, 'editDataBahan'])->name('adm.inv.bahan.e');
        Route::post('/bahan', [AdminInventaris::class, 'saveDataBahan'])->name('adm.inv.bahan.s');
        Route::delete('/bahan', [AdminInventaris::class, 'deleteDataBahan'])->name('adm.inv.bahan.d');
        Route::put('/bahan', [AdminInventaris::class, 'updateDataBahan'])->name('adm.inv.bahan.u');

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
        Route::get('/kas/{id}', [AdminKeuangan::class, 'indexKas'])->name('adm.keu.kasid');
        Route::get('/kas/edit/{id}', [AdminKeuangan::class, 'editKas'])->name('adm.keu.ekas');
        Route::post('/kas', [AdminKeuangan::class, 'saveKas'])->name('adm.keu.skas');
        Route::post('/kas/{id}', [AdminKeuangan::class, 'detailKas'])->name('adm.keu.dtkas');
        Route::put('/kas', [AdminKeuangan::class, 'updateKas'])->name('adm.keu.ukas');
        Route::delete('/kas', [AdminKeuangan::class, 'deleteKas'])->name('adm.keu.dkas');

    });

    Route::prefix('master')->group(function() {
        Route::get('/', [AdminMaster::class, 'indexDataPengguna']);
        Route::get('/mhs', [AdminMaster::class, 'indexDataPengguna'])->name('adm.master.user');
        Route::put('/mhs', [AdminMaster::class, 'resetPengguna'])->name('adm.master.resetuser');
        Route::put('/mhs/block', [AdminMaster::class, 'blockPengguna'])->name('adm.master.blockuser');
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

    Route::prefix('setting')->group(function() {
        Route::get('/', [AdminSetting::class, 'index'])->name('adm.setting');
        Route::put('/', [AdminSetting::class, 'updateSetting'])->name('adm.setting');

        Route::get('/password', [AdminSetting::class, 'updatePasswordView'])->name('adm.setting.pwd.index');
        Route::put('/password', [AdminSetting::class, 'saveUpdatePassword'])->name('adm.setting.pwd.save');
    });

});

Route::get('/', [Auth::class, 'loginFormUser'])->name('auth.loginmhs');
Route::post('/', [Auth::class, 'loginAkunUser'])->name('auth.loginmhs');
Route::get('/register', [Auth::class, 'registerFormUser'])->name('auth.regmhs');
Route::post('/register', [Auth::class, 'registerAkunUser'])->name('auth.regmhs');
Route::get('/profile', [Auth::class, 'profileFormUser'])->name('mhs.profile');
Route::post('/profile', [Auth::class, 'saveProfileUser'])->name('mhs.profile');
Route::get('/password', [Auth::class, 'updatePasswordView'])->name('mhs.password');
Route::post('/password', [Auth::class, 'updatePassword'])->name('mhs.password');
Route::get('/auth', [Auth::class, 'loginFormAdmin'])->name('auth.loginadmin');
Route::post('/auth', [Auth::class, 'loginAkunAdmin'])->name('auth.loginadmin');
Route::get('/logout', [Auth::class, 'logout'])->name('auth.logout');

