<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'prak_periode';
    protected $primaryKey = 'id_periode';
    protected $fillable = ['thn_ajaran', 'semester'];
}
