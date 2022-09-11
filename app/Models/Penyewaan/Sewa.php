<?php

namespace App\Models\Penyewaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa_penyewaan';
    protected $primaryKey = 'id_sewa';
    protected $fillable = ['id_user', 'id_alat', 'tgl_permohonan', 'tgl_sewa', 'tgl_kembali', 'jumlah', 'status', 'total_biaya'];

    public function alat()
    {
        return $this->belongsTo(\App\Models\Penyewaan\Alat::class, 'id_alat');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id_user');
    }
}
