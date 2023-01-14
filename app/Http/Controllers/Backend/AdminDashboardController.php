<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index (){
        return view('adminbashboard');
    }

    public function navBarContent(){
        $siteLogo = SiteSetting::first()->title_image;

        $user = User::where('is_admin', 'admin')->first();

        foreach($user->unreadNotifications as $notification){
            $notification['created_data'] = $notification['created_at']->diffForHumans();
         }

         $notifications = $user->unreadNotifications;

         return response()->json([
            "logo" => $siteLogo,
            'user' => $user,
            'notifications' => $notifications,
         ]);      
    }

    public function dashboardContent(){

        $orders = Order::latest()->take(10)->get();

        $products = Product::orderBy('view_count','DESC')->take(10)->with('category','images')->get();

        return response()->json([
            'orders' => $orders,
            'products' => $products,
        ]);
    }
}
