<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /// public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){

        return view('Restaurant.dashboard.index');
    }

    public function create(){
        return view('Restaurant.registration.register');
    }


    public function store(Request $request){
        // return $request->all();

        if(isset($request->rst_name)){

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:8',
                'rst_name' => 'required',
                'rst_address' => 'required',
                'phone' => 'required|max:15',
                'role_id' => 'required',
            ],[

            ]);

            // $slug = Str::of($request->rst_name)->slug('-');


            $insert = DB::transaction(function () use($request) {

                $slug = 'RO-'.uniqid();

                /*----------------------------------------------
                | insert into user table
                ------------------------------------------------ */

                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->slug = $slug;
                $user->role_id = $request->role_id;
                $user->save();

                /*----------------------------------------------
                | insert into restaurent owner table
                ------------------------------------------------ */

                $rstown_id = $user->id;
                $restaurent_id = str_replace(' ','',strtolower($request->rst_name.'-'.$rstown_id)) ;


                $rstown = new Restaurant;
                $rstown->rstown_id = $rstown_id;
                $rstown->restaurant_name = $request->rst_name;
                $rstown->phone = $request->phone;
                $rstown->restaurant_address = $request->rst_address;
                $rstown->restaurant_id = $restaurent_id;
                $rstown->rstown_slug = $slug;
                $rstown->created_at = Carbon::now()->toDateTimeString();
                $rstown->save();

                return 1;

            });


            if($insert){

                return redirect('/restaurant/dashboard');
            }
            else{
                dd($request->all());
                $request->session()->flash('error', 'Opps! Something Went Wrong.');
                return redirect('/restaurent-register');
            }
        }
        else{
            $request->session()->flash('error', 'Opps! Something Went Wrong.');
                return redirect('/restaurent-register');
        }

    }

    public function profile(){

        $user_id = Auth::user()->id;
        $rst_own = Restaurant::where('rstown_id',$user_id)->firstOrFail();

        return view('Restaurant.users.profile',compact('rst_own'));

    }


}
