<?php

namespace App\Models\Praktikum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarAnggotaKelompok extends Model
{
    use HasFactory;
    protected $table = 'prak_kelompokd';
    protected $fillable = ['id_user', 'id_kel', 'id_mhs', 'nilai'];
    public $timestamps = false;

    public function mhs()
    {
       return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
    public function parent()
    {
        return $this->hasOne(DaftarKelompok::class, 'id_kel', 'id_kel');
    }
}
