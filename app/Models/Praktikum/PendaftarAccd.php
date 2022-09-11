<?php

namespace App\Models\Praktikum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarAccd extends Model
{
    use HasFactory;
    protected $table = 'prak_pendaftar_accd';
    protected $fillable = ['id_daftar', 'id_user'];
    public $timestamps = false;

    public function mhs()
    {
       return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
}
