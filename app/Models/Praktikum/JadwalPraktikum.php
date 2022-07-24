<?php

namespace App\Models\Praktikum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktikum extends Model
{
    use HasFactory;
    protected $table = 'prak_jadwal';
    protected $fillable = ['id_kel', 'tgl_prak'];
    public $timestamps = false;
    
}
