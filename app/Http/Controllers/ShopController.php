<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopPageContents(){
        $categories = Category::with('products')->orderBy('viewCount','desc')->get();
        $popularProducts = Product::orderBy('view_count','desc')->limit(15)->get();
        return response()->json([
            'categories' => $categories,
            'popularProducts' => $popularProducts,
        ]);
    }

    public function tagProduct($slug){
        $tag = Tag::with('products.images','products.category')->where('slug',$slug)->first();
        $relatedProducts = $this->relatedProducts($tag);
       
            
        return response()->json([
            'tagProducts'=>$tag->products,
            'relatedPrdoucts' =>$relatedProducts,
           
        ]);
    }

    public function categoryProduct($slug){
        $category  = Category::with('products.category')->where('slug',$slug)->first();
        
        $relatedProducts = $this->relatedProducts($category);

        return response()->json([
            'catProducts' => $category->products,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function subCategoryProducts($slug){
        $subcategory = Subcategory::with('products.tags')->where('slug',$slug)->first();
        $subcategory_products = $subcategory->products;

        $relatedProducts = [];

        foreach($subcategory_products as $product){
            foreach($product->tags as $tag){
                if($tag){
                    foreach($tag->products as $product){
                        array_push($relatedProducts,$product);
                    }
                }
            }   
        }

        return response()->json([
            'subCatProducts' => $subcategory_products,
            'relatedProducts' => array_slice($relatedProducts,0,20),
        ]);
    }

    public function childCategoryProducts($slug){
        $childCategory = Childcategory::with('products.tags')->where('slug',$slug)->first();
        
        $relatedProducts = $this->relatedProducts($childCategory);

        return response()->json([
            'subCatProducts' => $childCategory->products,
            'relatedProducts' => array_slice($relatedProducts,0,20),
        ]);
    }

    private function relatedProducts($value){
        $related_products_ids=[];
        $prdouct_ids =[];
        
        foreach($value->products as $pro){
            array_push($prdouct_ids,$pro->id);
            foreach($pro->tags as $tag){
                if($tag){
                    foreach($tag->products as $product){
                        array_push($related_products_ids,$product->id);
                    }
                }
            }   
        }
        $product_diff_ids = array_diff($related_products_ids,$prdouct_ids);
        $unique_related_products_ids = array_unique($product_diff_ids);

        $relatedProducts = array();
        foreach($unique_related_products_ids as $id){
            $product = Product::where('id',$id)->with('images')->first();
            array_push($relatedProducts,$product);

        }
        return $relatedProducts;
    }
}
