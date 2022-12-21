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





Route::resource('/admin/product/image',ProductImageController::class)
->only(['index']);

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

