<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'mast_setting';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['dekan', 'kaprodi', 'kalab', 'periode_aktif', 'praktikum'];
}
