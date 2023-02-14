<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    private $previousWeekStart;
    private $previousWeekEnd;

    public function __construct()
    {
        $this->middleware('admin');
        $this->lastWeek();
    }

    private function lastWeek(){
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $this->previousWeekStart = date("Y-m-d",$start_week);
        $this->previousWeekEnd = date("Y-m-d",$end_week);
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

        [$currentWeekOrders,$weekPerOrder,$isOrderIncrease] = $this->valueCompare($model = 'order');
        [$currentWeekUsers,$weekPerUsers,$isUserIncrease] = $this->valueCompare($model = 'user');

        return response()->json([
            'orders' => $orders,
            'products' => $products,
            'currentWeekOrders' =>$currentWeekOrders,
            'weekPerOrder'  => $weekPerOrder, // week order different percentance
            'isOrderIncrease'  => $isOrderIncrease,

            'currentWeekUsers' =>$currentWeekUsers,
            'weekPerUsers'  => $weekPerUsers, // week order different percentance
            'isUserIncrease'  => $isUserIncrease,
        ]);
    }

    private function valueCompare($model){
        $now = Carbon::now();
        if($model == 'order'){
            $currentWeekData = Order::where('created_at', '>=', $now->week())->get();
            $previousWeekData  = Order::whereBetween('created_at',[$this->previousWeekStart, $this->previousWeekEnd])->get();
        }elseif($model == 'user'){
            $currentWeekData = User::where('created_at', '>=', $now->week())->get();
            $previousWeekData  = User::whereBetween('created_at',[$this->previousWeekStart, $this->previousWeekEnd])->get(); 
        }
        $currentWeekDataCount =  $currentWeekData->count();

        
        $previousWeekDataCount = $previousWeekData->count();

        if($currentWeekDataCount > 0){
            $weekDataDiff =   $currentWeekDataCount- $previousWeekDataCount;
            $weekPerDataDiff = ($weekDataDiff/ $currentWeekDataCount) * 100;
            $weekPerData = round($weekPerDataDiff,2); 
            if($weekPerData > 0){
                $positive = true;
            }else{
                $positive = false;
            }   
       }
       return [$currentWeekDataCount,$weekPerData,$positive];
    }
}
