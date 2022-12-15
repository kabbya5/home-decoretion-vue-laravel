<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetails($slug){
        $product = Product::with('category','subcategory','childcategory')->where('slug',$slug)->first();
        return response()->json($product);
    }
}
