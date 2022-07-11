<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'mast_dosen';
    protected $primaryKey = 'id_dosen';
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'alamat',
        'no_hp',
        'email',
    ];
}
