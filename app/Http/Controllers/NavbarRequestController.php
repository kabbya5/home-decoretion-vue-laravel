<?php

namespace App\Http\Controllers;


class NavbarRequestController extends Controller
{
    public function navbarRequest(){

        if (Route::has('login')){
            $route = 'login';
            $text  = 'login';
        }
        if (Route::has('register')){
            $route = 'register';
            $text  = 'register';
        }

        return response()->json([$route,$text]);
    }
}
