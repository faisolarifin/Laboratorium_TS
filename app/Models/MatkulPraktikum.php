<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulPraktikum extends Model
{
    use HasFactory;
    protected $table = 'prak_matkul_praktikum';
    protected $primaryKey = 'id_mp';
}
