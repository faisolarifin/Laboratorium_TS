<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPraktikumd extends Model
{
    use HasFactory;
    protected $table = 'prak_daftar_praktikumd';
    protected $fillable = ['id_daftarmp', 'id_mp'];
    public $timestamps = false;

    public function matkum()
    {
       return $this->belongsTo(MatkulPraktikum::class, 'id_mp');
    }
}
