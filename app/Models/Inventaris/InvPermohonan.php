<?php

namespace App\Models\Inventaris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvPermohonan extends Model
{
    use HasFactory;
    protected $table = 'inve_permohonan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'item_name',
        'req_by',
        'lab_name',
        'vendor',
        'catalog',
        'type',
        'spend_track',
        'other_detail',
        'qty',
        'unit_size',
        'url',
        'unit_price',
        'shipping',
        'po',
        'req',
        'confirm',
        'invoice',
        'tracking',
        'bought',
        'status',
        'req_date',
        'approv_date',
        'appove_by',
        'appove_msg',
        'order_date',
        'order_by',
        'order_msg',
        'cancel_date',
        'cencel_by',
        'cencel_msg',
        'backorder_date',
        'backorder_exp_date',
        'backorder_by',
        'backorder_msg',
        'receiv_date',
        'receiv_by',
        'receiv_msg',
        'notes',
    ];
}
