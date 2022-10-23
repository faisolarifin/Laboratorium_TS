<?php

namespace App\Models\Penelitian;

use App\Models\Pengujian\Percobaan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPercobaan extends Model
{
    use HasFactory;
    protected $table = 'plt_daftar_percobaan';
    protected $primaryKey = 'id_plt';
    public $timestamps = false;
    protected $fillable = [
        'id_plt',
        'id_percobaan',
        'jml_percobaan',
        'total_biaya',
    ];

    protected $with = ["pcb"];

    public function pcb() {
        return $this->belongsTo(Percobaan::class, 'id_percobaan', 'id_percobaan');
    }
}
