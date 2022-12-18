<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{
    public function addProductToWishlist(Product $product){
        
        $check_product_exsist_on_wishlist = Wishlist::where([
            ['user_id',Auth::id()],
            ['product_id', $product->id],
        ]);

        if(!$check_product_exsist_on_wishlist){
            Wishlist::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
            ]);
        }
        
    }
}
