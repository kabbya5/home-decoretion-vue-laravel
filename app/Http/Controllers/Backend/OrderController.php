<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    public function allOrders($status){
        if($status == 'new'){
            $orders = Order::where('status', 'new')->latest()->get();
        }elseif($status == 'accept'){
            $orders = Order::where('status', 'accept')->latest()->get();
        }elseif($status == 'shipping'){
            $orders = Order::where('status', 'shipping')->latest()->get();
        }elseif($status == 'completed'){
            $orders = Order::where('status','completed')->latest()->get();
        }elseif($status == 'cancle'){
            $orders = Order::where('status', 'cancle')->latest()->get();
        }
        else{
            $orders =  Order::latest()->get();
        }
        return response()->json(
           $orders
        );
    }

    public function show($slug){

        $order = Order::where('slug',$slug)->with('shipping','orderDetails.product','user')->first();

        $order['created_date'] =  $order->created_at->format('m-d-y') ;

        $order['created_time'] = $order->created_at->format('g:i A') ;

        $this->notificationRead();

        return response()->json([
            'order' => $order,
            'orderDetails' => $order->orderDetails,
            'user'   => $order->user,
            'shipping' => $order->shipping,
        ]);

    }

    public function update(Request $request,Order $order){
        $order->update([
            'status' => $request->status
        ]);
    }

    public function notificationRead(){
        $user = User::where('is_admin', 1)->first();
        $unreadNotification = $user->unreadNotificaions;
        if($unreadNotification){
            $id = $user->unreadNotifications[0]->id;
            $user->unreadNotifications->where('id', $id)->markAsRead();
        }
    }
}
