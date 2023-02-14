<?php

namespace App\Http\Controllers\Backend;

use App\Events\OrderProcessedEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
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
        $status = $request->status;
        $order->update([
            'status' => $status
        ]);

        $user_id = $order->user_id;
        $order_details = $order->orderDetails;  
        if($status=="shipping" || $status == "accept" || $status == "cacle"){
            event(new OrderProcessedEvent($user_id,$order,$status,$order_details));
        }
        
        if($status =='completed'){
            foreach($order_details as $detail){
                $product = Product::where('id',$detail->product_id)->first();
                $product->update([
                    'quantity' => $product->quantity - $detail->quantity
                ]);
            }
        }
    }

    public function notificationRead(){
        $user = User::where([['id', auth()->user()->id],['is_admin','admin']])->first();
        if(! $user->unreadNotifications === null){
            $id = auth()->user()->unreadNotifications[0]->id;
            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }  
    }
}
