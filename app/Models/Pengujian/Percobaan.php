<?php

namespace App\Models\Pengujian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percobaan extends Model
{
    use HasFactory;
    protected $table = 'pgj_percobaan';
    protected $primaryKey = 'id_percobaan';
    protected $fillable = [
        'id_pgj',
        'nm_percobaan',
    ];
}
