<?php

namespace App\Models\Penelitian;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;
    protected $table = 'plt_penelitian';
    protected $primaryKey = 'id_plt';
    protected $fillable = [
        'id_user',
        'tgl_daftar',
        'total_bayar',
        'dikirim_oleh',
        'diterima_oleh',
    ];

    protected $with = ["detail"];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(DaftarPercobaan::class, 'id_plt','id_plt');
    }
}
