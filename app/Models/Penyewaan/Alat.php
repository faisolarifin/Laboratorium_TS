<?php

namespace App\Models\Penyewaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;
    protected $table = 'sewa_alat';
    protected $primaryKey = 'id_alat';
    protected $fillable = ['nm_alat', 'biaya_umum', 'biaya_khusus', 'jumlah', 'kondisi'];

    public function mhs()
    {
        return $this->belongsTo(\App\Models\AkunMhs::class, 'id_mhs');
    }
}
