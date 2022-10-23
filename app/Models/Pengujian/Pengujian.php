<?php

namespace App\Models\Pengujian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    use HasFactory;
    protected $table = 'pgj_pengujian';
    protected $primaryKey = 'id_pgj';
    protected $fillable = [
        'nm_kategori',
        'nm_pengujian',
    ];
    public function pcb()
    {
        return $this->hasMany(Percobaan::class, 'id_pgj', 'id_pgj');
    }
}
