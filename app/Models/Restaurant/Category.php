<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'user_id',
        'restaurant_id',
        'category_slug',
        'category_status'
    ];

    public function restaurantOwner(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
