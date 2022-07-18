<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'mast_admin';
    protected $primaryKey = 'id';
    protected $fillable = ['nama'];
    
}
