<?php

namespace App\Http\Controllers;

use App\Models\ResentViewProduct;
use Auth;
class ResentViewController extends Controller
{
    public function getProducts(){
        $products = ResentViewProduct::with('product.category')->where('user_id',Auth::id())->latest()->take(12)->get();
        return response()->json($products);
    }
    
}
