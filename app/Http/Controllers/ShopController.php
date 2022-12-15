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
        $tag = Tag::with('products.images','products.category',)->where('slug',$slug)->first();
        
        $tagProducts = $tag->products;

        $product = $tagProducts[0];

        
        
        $relatedProducts = $this->relatedProducts($product);
       
            
        return response()->json([
            'tagProducts'=>$tagProducts,
            'relatedPrdoucts' =>$relatedProducts,
           
        ]);
    }

    public function categoryProducts($slug){
        $category  = Category::with('products.category')->where('slug',$slug)->first();
        $categoryProducts = $category->products;
        $product = $categoryProducts[0];
        
        $relatedProducts = $this->relatedProducts($product);

        return response()->json([
            'catProducts' => $categoryProducts,
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
            'relatedProducts' => $relatedProducts,
        ]);
    }

    private function relatedProducts($product){
        $relatedProducts = Product::with('category','subcategory','childcategory','images','tags')->whereHas('tags', function ($q) use ($product) {
            return $q->whereIn('tag_name', $product->tags->pluck('tag_name')); 
        })
        ->where('id', '!=', $product->id) 
        ->get();
        return $relatedProducts;
    }
}
