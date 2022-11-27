<?php

use App\Http\Controllers\Backend\AdminBashbordController;
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

Route::get('/admin/dashboard/',[AdminBashbordController::class,'index']);


Route::get('/', function () {
    return view('home');
});
Route::get('/admin/{any}', [AdminBashbordController::class,'index'])
  ->where('any','.*');
  
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])
  ->where('any','.*')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

