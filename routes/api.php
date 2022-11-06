<?php

use App\Http\Controllers\Backend\CategoryController;
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

// Route::get('/navbar/request/',[NavbarRequestController::class,'navbarRequest']);

// Admin 
Route::resource('admin/category',CategoryController::class);
