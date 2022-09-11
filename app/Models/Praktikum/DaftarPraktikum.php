<?php

namespace App\Models\Praktikum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPraktikum extends Model
{
    use HasFactory;
    protected $table = 'prak_daftar_praktikum';
    protected $primaryKey = 'id_daftarmp';
    protected $fillable = ['id_user', 'id_periode', 'status_bayar', 'status_acc_fix'];

    public function mhs()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
    public function periode()
    {
        return $this->belongsTo(\App\Models\Periode::class, 'id_periode');
    }
}
