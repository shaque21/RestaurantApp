<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant\Category;
use App\Models\Restaurant\Menu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Image;

class MenuController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $menus = Menu::with('category')->where('user_id',$user_id)->orderBy('id','DESC')->get();

        foreach ($menus as $menu) {
            $pieces = substr($menu->food_description, 0, 15);
            $menu->formated_description = $pieces;
        }
        return view('Restaurant.menu.all',compact('menus'));
    }

    public function add(){
        $user_id = Auth::user()->id;
        $categories = Category::where('user_id', $user_id)->where('category_status',1)->get();
        // dd($categories);
        return view('Restaurant.menu.add',compact('categories'));
    }

    public function store(Request $request){
        // dd($request->all());

        $request->validate([
            'food_name' => 'required',
            'food_price' => 'required',
            'category' => 'required',
            'food_description' => 'required|max:255',
            'food_photo' => 'required|mimes:jpg,jpeg,png,gif',
        ],[

        ]);

        $slug = 'menu'.'-'.rand(100000,999999);


        $insert = Menu::insertGetId([
            'food_name' => $request->food_name,
            'food_price' => $request->food_price,
            'category_id' => $request->category,
            'food_description' => $request->food_description,
            'food_slug' => $slug,
            'user_id' => $request->user_id,
            'restaurant_id' => $request->restaurant_id,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('food_photo')){
            $image=$request->file('food_photo');
            $imageName='menu-'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(450,250)->save(base_path('public/uploads/restaurant/menu/'.$imageName));

            Menu::where('id',$insert)->update([
                'food_photo'=>$imageName,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }

        if($insert){
            Session::flash('success', 'Menu Added Successfully!');
            return redirect('restaurant/menu/add');
        }
        else{
            Session::flash('error', 'Something Went Wrong.');
            return redirect('restaurant/menu/add');
        }


    }

    public function view($slug){
        // return $slug;
        $user_id = Auth::user()->id;
        $menu = Menu::with('category')->where('food_slug', $slug)
                ->where('user_id',$user_id)->firstOrFail();
        return view('Restaurant.menu.view', compact('menu'));

    }
    public function edit($slug){
        // return $slug;
        $user_id = Auth::user()->id;

        $menu = Menu::where('food_slug', $slug)->where('user_id',$user_id)->firstOrFail();
        // dd($menu);
        if($menu->food_status == 1){
            return view('Restaurant.menu.edit', compact('menu'));
        }
        else{
            Session::flash('error', 'This Menu is Inactive! Please Active First Then Edit.');
            return redirect('restaurant/menu/all');
        }


    }

    public function Update(Request $request){
        // dd($request->all());

        $request->validate([
            'food_name' => 'required',
            'food_price' => 'required',
            'category' => 'required',
            'food_description' => 'required|max:255',
        ],[

        ]);

        $slug = 'menu'.'-'.rand(100000,999999);

        $data = [
            'food_name' => $request->food_name,
            'food_price' => $request->food_price,
            'discount_id' => $request->discount_id,
            'category_id' => $request->category,
            'food_description' => $request->food_description,
            'food_slug' => $slug,
            'user_id' => $request->user_id,
            'restaurant_id' => $request->restaurant_id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];

        $menu = Menu::where('food_status',1)->where('id',$request->id)->firstOrFail();

        $photo = $menu->food_photo;

        if($request->hasFile('food_photo')){

            unlink('uploads/restaurant/menu/'.$photo);
            $request->validate([
                'food_photo' => 'required|mimes:jpg,jpeg,png,gif',
            ],[

            ]);

            $image=$request->file('food_photo');
            $imageName='menu-'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(450,250)->save(base_path('public/uploads/restaurant/menu/'.$imageName));

            $data['food_photo'] = $imageName;
        }

        $user_id = Auth::user()->id;
        $update = Menu::where('id',$request->id)
        ->where('user_id',$user_id)
        ->where('food_status', 1)
        ->update($data);

        if($update){
            Session::flash('success', 'Menu Updated Successfully!');
            return redirect('restaurant/menu/edit/'.$slug);
        }
        else{
            Session::flash('error', 'Something Went Wrong.');
            return redirect('restaurant/menu/edit/'.$slug);
        }


    }
    public function destroy(Request $request){
        // dd($request->all());
        $id = $_POST['modal_id'];
        $user_id = Auth::user()->id;

        $menu = Menu::where('food_status',1)->where('id',$id)->firstOrFail();
        $photo = $menu->food_photo;
        unlink('uploads/restaurant/menu/'.$photo);
        $delete = Menu::where('id', $id)->where('user_id',$user_id)->delete();

        if($delete){
            Session::flash('success', 'Menu Deleted Successfully!');
            return redirect('restaurant/menu/all');
        }
        else{
            Session::flash('error', 'Something Went Wrong.');
            return redirect('restaurant/menu/all');
        }
    }
    public function activeStatus(Request $request){
        // dd($request->all());
        $user_id = Auth::user()->id;
        $menu = Menu::where('user_id', $user_id)->find($request->id);
        $menu->food_status = $request->status;
        $menu->save();

        $data = array();
        if($menu->food_status == 1){
            $data['message'] = "Now This Item Is Activated.";
        }
        else{
            $data['message'] = "Now This Item Is Deactivated.";
        }
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

}
