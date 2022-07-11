<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarAccd extends Model
{
    use HasFactory;
    protected $table = 'prak_pendaftar_accd';
    protected $fillable = ['id_daftar', 'id_mhs'];
    public $timestamps = false;

    public function mhs()
    {
       return $this->belongsTo(AkunMhs::class, 'id_mhs');
    }
}
