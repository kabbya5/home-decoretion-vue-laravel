<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NavbarRequestController;
use App\Models\Slider;
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
Route::resource('/admin/category',CategoryController::class);
Route::get('/admin/slider',[SliderController::class,'getSliders']);
Route::post('/admin/slider/create',[SliderController::class,'create']);
Route::resource('/admin/subcategory',SubcategoryController::class)->except(['update','create','show']);
Route::controller(SubcategoryController::class)->group(function (){
    Route::delete('/admin/subcategory/restore/{id}','restore');
    Route::get('/admin/subcategory/trashed','trashed');
});
