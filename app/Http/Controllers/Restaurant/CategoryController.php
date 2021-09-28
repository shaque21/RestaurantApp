<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Restaurant\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class CategoryController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $categories = Category::with('restaurantOwner')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('Restaurant.category.all',compact('categories'));
    }

    public function add(){
        return view('Restaurant.category.add');
    }

    public function store(Request $request){
        // dd($request->all());

        $request->validate([
            'category_name' => 'required',
        ],[

        ]);

        $slug = 'cs'.'-'.rand(100000,999999);


        $insert = Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'user_id' => $request->user_id,
            'restaurant_id' => $request->restaurant_id,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success', 'Category Added Successfully!');
            return redirect('restaurant/category/add');
        }
        else{
            Session::flash('error', 'Something Went Wrong.');
            return redirect('restaurant/category/add');
        }


    }

    public function view($slug){
        // return $slug;
        $user_id = Auth::user()->id;
        $category = Category::where('category_slug', $slug)->where('user_id',$user_id)->firstOrFail();
        return view('Restaurant.category.view', compact('category'));

    }
    public function edit($slug){
        // return $slug;
        $user_id = Auth::user()->id;

        $category = Category::where('category_slug', $slug)->where('user_id',$user_id)->firstOrFail();
        return view('Restaurant.category.edit', compact('category'));

    }

    public function Update(Request $request){
        // dd($request->all());

        $request->validate([
            'category_name' => 'required',
        ],[

        ]);

        $slug = 'cs'.'-'.rand(1000000,9999999);

        $user_id = Auth::user()->id;
        $update = Category::where('id',$request->id)
        ->where('user_id',$user_id)
        ->update([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'user_id' => $request->user_id,
            'restaurant_id' => $request->restaurant_id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($update){
            Session::flash('success', 'Category Updated Successfully!');
            return redirect('restaurant/food/category/edit/'.$slug);
        }
        else{
            Session::flash('error', 'Something Went Wrong.');
            return redirect('restaurant/food/category/edit/'.$slug);
        }


    }
    public function destroy(Request $request){
        // dd($request->all());
        $id = $_POST['modal_id'];
        $user_id = Auth::user()->id;
        $delete = Category::where('id', $id)->where('user_id',$user_id)->delete();

        if($delete){
            Session::flash('success', 'Category Deleted Successfully!');
            return redirect('restaurant/food/category/all');
        }
        else{
            Session::flash('error', 'Something Went Wrong.');
            return redirect('restaurant/food/category/all');
        }
    }
    public function activeStatus(Request $request){
        $user_id = Auth::user()->id;
        $category = Category::where('user_id', $user_id)->find($request->category_id);
        $category->category_status = $request->status;
        $category->save();

        $data = array();
        if($category->category_status == 1){
            $data['message'] = "Now This Category Is Activated.";
        }
        else{
            $data['message'] = "Now This Category Is Deactivated.";
        }
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

}
