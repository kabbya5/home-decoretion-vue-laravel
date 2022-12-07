<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function verifyEmail(){
        $site_setting = SiteSetting::first();
        // dd($site_setting->page_title);
        return view('auth.verify',compact('site_setting'));
    }
}
