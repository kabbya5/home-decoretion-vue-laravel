<?php

namespace App\Http\Controllers;

use App\Models\DeliverySetting;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\User;
use App\Notifications\AdminOrderCreateNotificaton;
use App\Notifications\UserOrderConfomation;
use Cart;
use Session;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class CheckoutController extends Controller
{
    public function getDeliverySettings(){

        $freeShipping = $this->freeShippingCalculated();

        return response()->json([      
            'coupon' => Session::get('coupon'),
            'deliverySystem' => DeliverySetting::all(),
            'freeShipping' => $freeShipping,
        ]);
    }

    private function freeShippingCalculated(){
        $carts = Cart::content();
        foreach($carts as $cart){
            $freeShipping = $cart->options->free_shipping;
            if($freeShipping){
                return 'free shipping';
            }
        }
        return null;
    }

    public function orderStore(Request $request){
        $request->validate([
            'agree' => "required",
            'name' => 'required|min:2|max:100',
            "address" => 'required',
            'comment' => 'min:15',
            'email' => "email",
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'district' => 'required',
        ],[
            'agree.required' => 'You must agree to the Terms and Conditions!'
        ]);

        $input = $request->only('payment_type','delivery_type','delivery_cost');
        
        $order_code = 'MDBD'. rand();
    
        $input['user_id'] = Auth::id();
        $input['order_code'] = $order_code;
        $input['slug'] = str_slug($order_code . Auth::id());

        $coupon = $request->coupon;
        if($coupon){
            $input['coupon'] =  $coupon['coupon_name'];
            $input['discount'] = $coupon['get_discount'];
            $input['subtotal'] = $coupon['finalDiscount'];
        }else{
            $input['subtotal'] = $request->subtotal;
        }

        $order_id = Order::create($input)->id;

        $shipping_data = $request->only('name','email','address','phone','district','comment');
        $shipping_data['user_id'] = Auth::id();
        $shipping_data['order_id'] = $order_id;

        Shipping::create($shipping_data);

        $carts = Cart::content();
        foreach ($carts as $row) {
            $details = array(
                'order_id' => $order_id,
                'product_id' => $row->options->product_id,
                'color' => $row->options->color,
                'size' => $row->options->size,
                'quantity' => $row->qty,
                'single_price' => $row->price,
                'total_price' => $row->qty*$row->price,
            );
            OrderDetails::create($details); 
        }

        $this->sendAdminOrderConfomation($input,$shipping_data,$carts);
        $this->sendUserOrderConfomation($input,$shipping_data,$carts);

        Cart::destroy();

        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        
    }

    private function sendAdminOrderConfomation($input,$data,$carts){
        $admins = User::where('is_admin',1)->get();
        Notification::send($admins,new AdminOrderCreateNotificaton($input,$data,$carts));
    }

    private function sendUserOrderConfomation($input,$data,$carts){
        $user = User::where('id', Auth::id())->first();
        Notification::send($user,new UserOrderConfomation($input,$data,$carts));
    }
}
