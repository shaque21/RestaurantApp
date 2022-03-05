<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
     protected $fillable = [
        'ord_tracking_id',
        'ord_id',
        'mnu_id',
        'qty',
        'disc',
        'price',
        'attr1',
        'attr2',
        'attr3',
    ];
}
