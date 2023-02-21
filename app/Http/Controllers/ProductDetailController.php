<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ResentViewProduct;
use App\Models\SiteSetting;
use Auth;
use Session;

class ProductDetailController extends Controller
{
    public function productDetails($slug){
        $product = Product::with('category','subcategory','childcategory')->where('slug',$slug)->first();

        $returnPolicy = SiteSetting::first()->return_policy;

        $relatedProducts = Product::with('category',)->whereHas('tags', function ($q) use ($product) {
            return $q->whereIn('tag_name', $product->tags->pluck('tag_name')); 
        })
        ->where('id', '!=', $product->id) 
        ->get();

        $resent_products = $this->resentViewProducts($product);


        $this->add_product_on_resent_view_table($product->id,$product);

        $this->incrementColumn($product);

        return response()->json([
            'product' => $product,
            'returnPolicy' => $returnPolicy,
            'relatedProducts' => $relatedProducts,
            'resentView'  => $resent_products,
        ]);
    }

    private function add_product_on_resent_view_table($id){
        $userid = Auth::id();
        $productCheck = ResentViewProduct::where('user_id',$userid)->where('product_id',$id)->first();

        if($userid){
            if($productCheck){
                return back();
                
            }else{
                ResentViewProduct::create([
                    'product_id' => $id,
                    'user_id' => $userid, 
                ]);
            }  
        }
    }

    private function resentViewProducts($product){
        if(Auth::id()){
            $resent_products = ResentViewProduct::with('product')->where('user_id',Auth::id())->latest()->take(10)->get();
            return $resent_products;
        }
    }

    private function incrementColumn($product){
        $product->update(['view_count' => $product->view_count + 1]);

        $product->category->update(['view_count' => $product->category->view_count + 1]);
    }
}
