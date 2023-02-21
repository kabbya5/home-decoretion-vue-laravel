<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserOrderController extends Controller
{
    public function index(){
        $user_id = Auth::id();

        $orders = Order::latest()->where('user_id',$user_id)->get();

        return response()->json($orders);
    }

    public function userOrderDetails($slug){
        $order = Order::where('slug',$slug)->with('shipping','orderDetails.product','user')->first();

        $order['created_date'] =  $order->created_at->format('m-d-y');

        $order['created_time'] = $order->created_at->format('g:i A');

        $this->notificationRead();

        return response()->json([
            'order' => $order,
            'orderDetails' => $order->orderDetails,
            'user'   => $order->user,
            'shipping' => $order->shipping,
        ]);
    }

    private function notificationRead(){
        $user = User::where('id', Auth::id())->first();
        DB::table('notifications')->where('notifiable_id',$user->id)->update(['read_at' => Carbon::now()]);
        return;
    }
}
