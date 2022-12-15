<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Cart;
use Session;
use PHPUnit\Framework\Constraint\Count;

class ShoppingCartController extends Controller
{

    public function cartContent(){
        $siteSetting = SiteSetting::first();
        $carts = Cart::content();
        $total = Cart::subtotal();
        return response()->json([
            'carts' => $carts,
            'siteSetting' => $siteSetting,
            'subtotal' => $total,
        ]);
    }
    public function addCart(Request $request,Product $product){
        $cart = array();
        $cart['id'] = $product->slug;
        $cart['name'] = $product->slug;

        if($request->quantity){
            $cart['qty'] = $request->quantity;
        }else{
            $cart['qty'] = 1;
        }
        
        $cart['weight'] = $product->weight; 
        
        if($request->color){
            $cart['options']['color'] = $request->color;
        }else{
            $cart['options']['color'] = ' ';
        }

        if($request->size){
            $cart['options']['size'] = $request->size;
        }else{
            $cart['options']['size'] = ' ';
        }

        if($product->image_url){
            $cart['options'] ['img'] = $product->image_url;
        }

        $cart['options']['product_title'] = $product->product_title;

        $cart['options']['seller_id'] = $product->seller_id;

        if($product->discount_price){
            $price = $product->discount_price;
        }else{
            $price = $product->price;
        }

        $cart['price'] = $price + $request->size_extra_payment;

        Cart::add($cart);
        
    }
    public function updateCartQty(Request $request,$rowId){
        Cart::update($rowId,$request->qty);
    }

    public function removedCartProduct($rowId){
        Cart::remove($rowId);
    }
    public function cartDestroy(){
        Cart::destroy();
    }
    public function applyCoupon(Request $request){
        $request->validate([
            'coupon_name' => 'required',
        ]);

        $coupon = Coupon::where([
            ['coupon_name', $request->coupon_name],
            ['is_active','active'],
            ])->first();

        if($coupon){
            $coupon['subTotal'] = $subTotal =  (int)str_replace(',', '', Cart::Subtotal());
            $amount = $coupon->discount;
            $percenInAmount = $amount/number_format(100);
            $coupon['get_discount'] = round($coupon['subTotal'] * $percenInAmount);
            $coupon['finalDiscount'] = $coupon['subTotal'] - $coupon['get_discount']; 

            Session::put('coupon',$coupon);
            
            return response()->json($coupon);

        }else{
            return response()->json([
                'errors' => [
                    'unvalid' => 'Unvalid Coupon Code !' 
                ]
            ], 429);
        }   
    }
}
