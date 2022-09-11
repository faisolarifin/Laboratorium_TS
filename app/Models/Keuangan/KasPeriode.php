<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasPeriode extends Model
{
    use HasFactory;
    protected $table = 'keu_kas_periode';
    protected $primaryKey = 'id_kasp';
    protected $fillable = [
        'id_periode',
        'saldo_awal',
        'sisa_saldo',
        'ket',
    ];
    public function periode()
    {
        return $this->belongsTo(\App\Models\Periode::class, 'id_periode');
    }
}
