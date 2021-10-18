<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Restaurant\Menu;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){

        $restaurant = Restaurant::where('rstown_id',Auth::user()->id)->firstOrFail();
        $restaurant_id = $restaurant->restaurant_id;



        $menus = Menu::where('restaurant_id',$restaurant_id)->where('food_status',1)->get();
        return view('Restaurant.order.index',compact('menus'));
    }
}
