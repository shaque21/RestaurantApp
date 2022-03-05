<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'ord_tracking_id',
        'rest_own_id',
        'rest_id',
        'cus_name',
        'cus_mob',
        'pay_method',
        'sub_total',
        'attr1',
        'attr2',
        'attr3',
    ];
}
