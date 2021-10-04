<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Frontend\SingleRestaurantController;
use App\Http\Controllers\Restaurant\CategoryController;
use App\Http\Controllers\Restaurant\MenuController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

// ============ Route for admin ===============
Route::get('/admin-login',function(){
    if(!Auth::user()){
    return view('Admin.login');
    }
});
Route::group(['middleware' => ['admin','auth'],'namespace' => 'admin'], function(){

    /*-----------------------------------------------------------------------------------------
    | Admin Users Manage part
    -----------------------------------------------------------------------------------------*/
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/users',[AdminController::class,'all_user']);
    Route::get('/admin/users/view/{id}',[AdminController::class,'view']);
    Route::post('admin/users/softdelete',[AdminController::class,'softdelete']);

    /*-----------------------------------------------------------------------------------------
    | Admin Restaurnt Manage part
    -----------------------------------------------------------------------------------------*/
    Route::get('admin/restaurents',[AdminController::class,'allRestaurent'])->name('restaurent.all');
    Route::get('/admin/restaurents/view/{id}',[AdminController::class,'viewRestaurent']);
    Route::get('/admin/restaurents/activeStatus',[AdminController::class,'activeStatus'])->name('restaurent.active');
    Route::post('admin/restaurents/softdelete',[AdminController::class,'softDeleteRestaurent']);

    /*-----------------------------------------------------------------------------------------
    | Admin Profile part
    -----------------------------------------------------------------------------------------*/
    Route::get('/admin/profile',[AdminController::class,'profile']);
    Route::get('admin/profile/edit',[AdminController::class,'edit']);
    Route::get('admin/upload-photo',[AdminController::class,'edit_photo']);
    Route::post('/admin/profile/update',[AdminController::class,'update_profile']);
    Route::post('/admin/photo/update',[AdminController::class,'update_photo']);


    /*-----------------------------------------------------------------------------------------
    | Admin Recycle part
    -----------------------------------------------------------------------------------------*/

    Route::get('admin/recycle',[AdminController::class,'recycle']);
    Route::post('admin/users/restore',[AdminController::class,'restore']);
    Route::post('admin/restaurant/restore',[AdminController::class,'rst_restore']);
    Route::post('admin/users/delete',[AdminController::class,'delete']);
    Route::post('admin/restaurant/delete',[AdminController::class,'rst_delete']);


});



// ============ Route for admin ===============

// ============ Route for Customer ===============

Route::group(['middleware' => ['customer','auth'],'namespace' => 'customer'], function(){

    Route::get('/customer/dashboard',[CustomerController::class,'index'])->name('customer.dashboard');

});




// ============ Route for Customer ===============

// ============ Route for Restaurant Owner ===============

Route::group(['middleware' => ['restaurant','auth'],'namespace' => 'restaurant'], function(){

    /*--------------------------------------------------------------------
    | Food Category  Routes
    -----------------------------------------------------------------------*/

    Route::get('restaurant/food/category/all',[CategoryController::class, 'index'])->name('food.category.all');
    Route::get('restaurant/category/add',[CategoryController::class, 'add'])->name('category.add');
    Route::post('restaurant/food/category/store',[CategoryController::class, 'store'])->name('category.store');
    Route::get('restaurant/food/category/view/{slug}',[CategoryController::class, 'view'])->name('food.category.view');
    Route::get('restaurant/food/category/edit/{slug}',[CategoryController::class, 'edit'])->name('food.category.edit');
    Route::post('restaurant/food/category/update',[CategoryController::class, 'update'])->name('food.category.update');
    Route::post('restaurant/food/category/delete',[CategoryController::class, 'destroy'])->name('food.category.delete');
    Route::get('restaurant/food/category/activeStatus',[CategoryController::class,'activeStatus'])->name('food.category.active');

    /*--------------------------------------------------------------------
    | Menu Management  Routes
    -----------------------------------------------------------------------*/

    Route::get('restaurant/menu/all',[MenuController::class, 'index'])->name('menu.all');
    Route::get('restaurant/menu/add',[MenuController::class, 'add'])->name('menu.add');
    Route::post('restaurant/menu/store',[MenuController::class, 'store'])->name('menu.store');
    Route::get('restaurant/menu/view/{slug}',[MenuController::class, 'view'])->name('menu.view');
    Route::get('restaurant/menu/edit/{slug}',[MenuController::class, 'edit'])->name('menu.edit');
    Route::post('restaurant/menu/update',[MenuController::class, 'update'])->name('menu.update');
    Route::post('restaurant/menu/delete',[MenuController::class, 'destroy'])->name('menu.delete');
    Route::get('restaurant/menu/activeStatus',[MenuController::class,'activeStatus'])->name('menu.active');


    Route::get('/restaurant/dashboard',[RestaurantController::class,'index'])->name('restaurant.dashboard');

    Route::get('/restaurant/profile',[RestaurantController::class,'profile']);

});

Route::get('/restaurant-register',[RestaurantController::class,'create']);
Route::post('/add-restaurent-owner',[RestaurantController::class,'store']);

// ============ Route for Restaurant Owner ===============

/*-----------------------------------------------------------------
| Frontend Routes
-----------------------------------------------------------------------*/

Route::get('restaurant/{slug}', [SingleRestaurantController::class, 'show'])->name('restaurant');
Route::post('restaurant/food/view', [SingleRestaurantController::class, 'view'])->name('food.view');

/*-----------------------------------------------------------------
| Common Routes
-----------------------------------------------------------------------*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'view'])->name('home');


