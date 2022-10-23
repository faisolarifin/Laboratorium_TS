<?php

namespace App\Models\Penelitian;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $table = 'plt_permohonan';
    protected $primaryKey = 'id_pmh';
    protected $fillable = [
        'id_user',
        'tgl_permohonan',
        'proposal',
        'srt_permohonan',
        'link_formulir',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
