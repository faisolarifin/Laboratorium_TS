<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunMhs extends Model
{
    use HasFactory;
    protected $table = 'akun_mhs';
    protected $primaryKey = 'id_mhs';
    protected $fillable = [
        'nama',
        'nim',
        'password',
        'alamat',
        'tmp_lahir',
        'tgl_lahir',
        'no_hp',
        'email',
        'foto',
        'status'
    ];
}
