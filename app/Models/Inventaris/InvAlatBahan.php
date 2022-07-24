<?php

namespace App\Models\Inventaris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvAlatBahan extends Model
{
    use HasFactory;
    protected $table = 'inve_alat_bahan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'serial_num',
        'item_name',
        'item_name ',
        'vendor',
        'catalog',
        'owner',
        'location',
        'sub_loc',
        'loc_detail',
        'price',
        'amount_ins',
        'unit_size',
        'url',
        'tech_detail',
        'expired_date',
        'lot_num',
        'cas_num',
        'cont_person',
        'cont_phone',
        'install_date',
        'publish_date',
        'mntc_hist',
        'serial',
        'univ_tag',
    ];
}
