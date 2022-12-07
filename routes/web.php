<?php

use App\Http\Controllers\Backend\AdminBashbordController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

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

//admin 
Auth::routes(['verify' => true]);
Route::get('/email/verify', [HomeController::class,'verifyEmail']);
Route::get('/admin/dashboard/',[AdminBashbordController::class,'index']);


Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin','verified']],
function(){

  Route::post('/site/setting/create',[SiteSettingController::class,'store']);
  Route::get('/site/setting/edit',[SiteSettingController::class,'edit']);
  Route::put('/site/setting/update/{site_setting}/',[SiteSettingController::class,'update']);

  // product 

  Route::get('/products',[ProductController::class,'index']);
  Route::get('/product/create',[ProductController::class,'create']);
  Route::post('/product/store',[ProductController::class,'store']);
  Route::get('/product/edit/{product}',[ProductController::class,'edit']);
  Route::put('/product/update/{product}',[ProductController::class,'update']);
  Route::post('/size/store',[SizeController::class,'store']);

});

// user 

Route::controller(HomePageController::class)->group(function (){
  Route::get('/get/cateogry/index/{width}','getCategory');
  Route::get('/get/week/products','weekSaleProduct');
  
});



Route::get('/admin/{any}', [AdminBashbordController::class,'index'])
->where('any','.*');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])
  ->where('any','.*')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

