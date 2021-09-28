<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Restaurant\Menu;
use App\Models\Restaurant\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleRestaurantController extends Controller
{
    public function show($slug){

        $restaurant = Restaurant::where('rst_status', 1)
                    ->where('rstown_slug', $slug)->firstOrFail();
        // dd($restaurant);
        $restaurant_id = $restaurant->restaurant_id;
        $user_id = $restaurant->rstown_id;

        // dd($restaurant_id);
        $categories = Category::where('user_id', $user_id)
            ->where('restaurant_id', $restaurant_id)
            ->where('category_status', 1)
            ->get();

        // $menus = array();
        foreach($categories as $item){
            $menus = DB::table('menus')
            ->join('categories', 'menus.category_id', 'categories.id')
            ->where('menus.user_id', $user_id)
            ->where('menus.restaurant_id', $restaurant_id)
            ->where('menus.food_status', 1)
            ->get();
        }
        // dd($menus);
        return view('frontend.singleRestaurant.single', compact('menus','categories','restaurant'));
    }

    public function view(Request $request) {
        // dd($request->all());
        $food_slug = $request->food_slug;
        $menu = Menu::where('food_slug',$food_slug)->firstOrFail();
        // dd($menu);
        $data['food_name'] = $menu->food_name;
        $data['food_description'] = $menu->food_description;
        $data['food_photo'] = $menu->food_photo;
        $data['food_price'] = $menu->food_price;
        // dd($data);
        if ($data) {
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }
}
