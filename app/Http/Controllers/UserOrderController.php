<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

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

        // $this->notificationRead();

        return response()->json([
            'order' => $order,
            'orderDetails' => $order->orderDetails,
            'user'   => $order->user,
            'shipping' => $order->shipping,
        ]);
    }
}
