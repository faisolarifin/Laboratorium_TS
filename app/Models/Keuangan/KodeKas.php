<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeKas extends Model
{
    use HasFactory;
    protected $table = 'keu_kode_kas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nm_kode',
        'harga',
        'ket',
    ];
}
