<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $table = 'keu_kas';
    protected $primaryKey = 'id_kas';
    protected $fillable = [
        'id_kasp',
        'id_kode',
        'tgl',
        'nama',
        'harga',
        'jumlah',
        'tipe',
        'total',
    ];
    public function kasp()
    {
        return $this->belongsTo(KasPeriode::class, 'id_kasp');
    }
    public function kode()
    {
        return $this->belongsTo(KodeKas::class, 'id_kode', 'id');
    }
}
