<?php

namespace App\Models\Praktikum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulPraktikum extends Model
{
    use HasFactory;
    protected $table = 'prak_matkul_praktikum';
    protected $primaryKey = 'id_mp';
    protected $fillable = ['nama_mp', 'harga', 'deksripsi'];
}
