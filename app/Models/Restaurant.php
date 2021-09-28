<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_name',
        'restaurant_address',
        'rstown_slug',
        'rst_status',
        'rstown_id',
    ];

    public function users(){
        return $this->belongsTo('App\Models\User','rstown_id','id');
    }
}
