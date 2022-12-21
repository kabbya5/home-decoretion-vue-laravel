<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{

    public function index(){
        return response()->json(
            Wishlist::latest()->with('product')->get(),
        );
    }

    public function addProductToWishlist(Product $product){
        
        $userid = Auth::id();

        $check_product_exsist_on_wishlist = Wishlist::where([
            ['user_id',$userid],
            ['product_id', $product->id],
        ])->first();

        
        if(Auth::check()){
            if($check_product_exsist_on_wishlist){
                return response()->json([
                    'errors' => [
                        'product_exsist' => 'product already exsist on you wishlist !',
                    ]
                ],429);
                
            }else{
                Wishlist::create([
                    'product_id' => $product->id,
                    'user_id' => $userid, 
                ]);
            }
            
        }else{
            return response()->json([
                'errors' => [
                    'unauthenticate' => "At first login Your Account !",
                ]
            ],429);
        }
        
    }

    public function delete(Wishlist $wishlist){
        $wishlist->delete();
    }
}
