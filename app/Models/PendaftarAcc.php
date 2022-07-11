<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarAcc extends Model
{
    use HasFactory;
    protected $table = 'prak_pendaftar_acc';
    protected $primaryKey = 'id_daftar';
    protected $fillable = ['id_periode', 'id_mp', 'status_generate'];

    public function matkum()
    {
        return $this->belongsTo(MatkulPraktikum::class, 'id_mp');
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
    public function detail()
    {
        return $this->belongsTo(PendaftarAccd::class, 'id_daftar', 'id_daftar');
    }

}
