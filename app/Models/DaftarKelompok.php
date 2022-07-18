<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKelompok extends Model
{
    use HasFactory;
    protected $table = 'prak_kelompok';
    protected $primaryKey = 'id_kel';
    protected $fillable = ['id_periode', 'id_mp', 'nm_kel', 'tgl_ujian', 'asprak', 'pembimbing', 'penguji', 'penguji2'];

    public function matkum()
    {
        return $this->belongsTo(MatkulPraktikum::class, 'id_mp');
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
    public function pbb()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing', 'id_dosen');
    }
    public function pgj()
    {
        return $this->belongsTo(Dosen::class, 'penguji', 'id_dosen');
    }
    public function pgj2()
    {
        return $this->belongsTo(Dosen::class, 'penguji2', 'id_dosen');
    }
    public function detail()
    {
        return $this->belongsTo(DaftarAnggotaKelompok::class, 'id_kel', 'id_kel');
    }

}
