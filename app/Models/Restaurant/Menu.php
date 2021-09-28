<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_name',
        'food_description',
        'food_price',
        'category_id',
        'food_photo',
        'discount_id',
        'user_id',
        'restaurant_id',
        'food_slug',
        'food_status'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Restaurant\Category','category_id','id');
    }
    public function restaurantOwner(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
