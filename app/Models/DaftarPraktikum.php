<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPraktikum extends Model
{
    use HasFactory;
    protected $table = 'prak_daftar_praktikum';
    protected $primaryKey = 'id_daftarmp';
    protected $fillable = ['id_mhs', 'id_periode', 'status_bayar', 'status_acc_fix'];

    public function mhs()
    {
        return $this->belongsTo(AkunMhs::class, 'id_mhs');
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
