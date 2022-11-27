<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NavbarRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/navbar/category',[NavbarRequestController::class,'getNavbarCategory']);

Route::get('/get/cateogry/index',[HomePageController::class,'getCategory']);

// Admin 
Route::controller(CategoryController::class)->group(function(){
    Route::get('/admin/category','index');
    Route::put('/admin/category/update/{category}','update');
    Route::delete('/admin/category/delete/{category}','destroy');
    Route::post('/admin/category/restore/{id}','restore');
    Route::get('/admin/category/trashed','trashed');
    Route::delete('/admin/category/force/delete/{id}','forceDelete');

});

Route::resource('/admin/subcategory',SubcategoryController::class)->only(['destroy','index','store']);
Route::controller(SubcategoryController::class)->group(function (){
    Route::delete('/admin/subcategory/restore/{id}','restore');
    Route::get('/admin/subcategory/trashed','trashed');
    Route::delete('/admin/subcategory/permament/delete/{subcatgory}','forceDelete');
    Route::put('/admin/subcatgory/update/{id}','update');
});
Route::resource('/admin/brand',BrandController::class);
Route::controller(BrandController::class)->group(function (){
    Route::put('/admin/brand/update/{brand}','update');
});

Route::resource('/admin/slider',SliderController::class);
Route::controller(SliderController::class)->group(function (){
    Route::put('/admin/slider/update/{slider}','update');
});

Route::resource('/admin/product/image',ProductImageController::class)
->only(['index']);
Route::controller(ProductImageController::class)->group(function(){
    Route::post('/admin/product/image/create','store');
    Route::put('/admin/product/image/update/{productImage}','update');
    Route::delete('/admin/product/image/{productImage}', 'destroy');
    Route::post('/admin/product/image/restore/{productImage}','restore');
    Route::get('/admin/product/image/trashed','trashed');
    Route::delete('/admin/product/image/force/delete/{id}', 'forceDelete');
});
Route::controller(ColorController::class)->group(function(){
    Route::post('/admin/product/color/create','store');
    Route::get('/admin/product/color','index');
    Route::put('/admin/product/color/update/{color}','update');
});

Route::controller(ProductController::class)->group(function (){
    Route::get('/admin/product/create','create');
    Route::post('/admin/product/store','store');
});

Route::controller(SizeController::class)->group(function(){
    Route::post('/admin/size/store','store');
});

