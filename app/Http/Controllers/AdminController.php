<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('Admin.dashboard.index');
    }



    public function all_user(){

        $users = User::where('status',1)->orderBy('id','DESC')->get();

        // $restaurants = DB::table('restaurants')
        //     ->join('users','restaurants.rstown_id','users.id')
        //     ->where('users.status',1)
        //     ->get();
        return view('Admin.users.all',compact('users'));

    }

    public function profile(){

        $user_id = Auth::user()->id;
        $user = User::where('status',1)->where('id',$user_id)->firstOrFail();

        return view('Admin.profile.profile',compact('user'));

    }

    public function edit(){
        $id = Auth::user()->id;

        $data = User::where('status',1)->where('id',$id)->firstOrFail();

        return view('Admin.profile.edit',compact('data'));
    }

    public function update_profile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'email|required|string',
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'password_confirmation' => ['same:new_password'],
        ],[]);

        $slug = 'a-'.uniqid(20);

        $update = User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'slug' => $slug,
            'password'=> Hash::make($request->new_password),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        if($update){

            $request->session()->flash('success', 'Profile updated successfully');
            return redirect('/admin/profile');
        }
        else{
            $request->session()->flash('error', 'Something Went Wrong');
            return redirect('/admin/profile/edit');
        }

    }

    public function edit_photo(){

        $admin = User::where('status',1)->where('id',Auth::user()->id)->firstOrFail();
        return view('Admin.profile.edit_photo',compact('admin'));
    }

    public function update_photo(Request $request){
        $id = $request->id;

        $request->validate([
            'photo' => 'mimes:png,jpg,jpeg,gif',
        ],[]);

        $user_name = strtolower(Auth::user()->name);

        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $image_name = $user_name.'-'.$request->id.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save(base_path('public/uploads/admin/'.$image_name));

        }
        $update = User::where('status',1)->where('id',$id)->update([
            'photo' => $image_name,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            Session::flash('update_success','Photo Updated');
            return redirect('admin/upload-photo');
        }
        else{
            Session::flash('update_error','Something were wrong');
            return redirect('admin/upload-photo');
        }
    }

    public function view($id){

        // $url_id = $_GET['id'];
        $id = decrypt($id);
        $data=User::where('status',1)->where('id',$id)->firstOrFail();
        return view('admin.users.view',compact('data'));

    }

    public function softdelete(){

        $id=$_POST['modal_id'];

        $softDelete=User::where('status',1)->where('id',$id)->update([
            'status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($softDelete){
            Session::flash('success','user information is deleted.');
            return redirect('admin/users');
        }
        else{
            Session::flash('error','Something Went Wrong.');
            return redirect('admin/users');
        }
    }

    public function recycle(){

        $users = User::where('status',0)->where('role_id',3)->get();

        $restaurants = DB::table('restaurants')
            ->join('users','restaurants.rstown_id','users.id')
            ->where('users.status',0)
            ->where('users.role_id',2)
            ->get();

            // return $restaurants;
        return view('Admin.recycle.all',compact('users','restaurants'));

    }

    public function restore(){

        $id=$_POST['modal_id'];

        $restore=User::where('status',0)->where('id',$id)->update([
            'status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($restore){
          Session::flash('success','user information is restored.');
          return redirect('admin/recycle');
        }
        else{
          Session::flash('error','Something Went Wrong.');
          return redirect('admin/recycle');
        }
    }

    public function rst_restore(){

        $id=$_POST['modal_id'];

        $restore=User::where('status',0)->where('id',$id)->update([
            'status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($restore){
          Session::flash('success','user information is restored.');
          return redirect('admin/recycle');
        }
        else{
          Session::flash('error','Something Went Wrong.');
          return redirect('admin/recycle');
        }
    }

    public function delete(){

        $id=$_POST['modal_id'];
        $del=User::where('status',0)->where('id',$id)->delete();

        if($del){
          Session::flash('success','User information is deleted permanently.');
          return redirect('admin/recycle');
        }
        else{
          Session::flash('error','Something Went Wrong.');
          return redirect('admin/recycle');
        }
    }

    public function rst_delete(){



        $del = DB::transaction(function () {
            $id=$_POST['modal_id'];

            User::where('status',0)->where('id',$id)->delete();

            Restaurant::where('rstown_id',$id)->delete();
            return 1;
        });


        if($del){
          Session::flash('success','Restaurant Owner information is deleted permanently.');
          return redirect('admin/recycle');
        }
        else{
          Session::flash('error','Something Went Wrong.');
          return redirect('admin/recycle');
        }
    }

    public function allRestaurent(){

        $restaurents = Restaurant::orderBy('id','DESC')->with('users')->get();
        // $restaurents = DB::table('restaurants')->get();
        // dd($restaurents);

        return view('Admin.restaurent.all',compact('restaurents'));
    }

    public function activeStatus(Request $request){
        $restaurent = Restaurant::find($request->user_id);
        $restaurent->rst_status = $request->status;
        $restaurent->save();

        $data = array();
        if($restaurent->rst_status == 1){
            $data['message'] = "Now This Restaurent Is Activated.";
        }
        else{
            $data['message'] = "Now This Restaurent Is Deactivated.";
        }
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

}
