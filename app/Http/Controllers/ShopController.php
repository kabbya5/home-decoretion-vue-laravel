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

        $product = $tagProducts[1];

        
        
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
        $subcategory = Subcategory::with('products.category')->where('slug',$slug)->first();
        $subcategory_products = $subcategory->products;

        $product = $subcategory_products[0];
        
        $relatedProducts = $this->relatedProducts($product);


        return response()->json([
            'subCatProducts' => $subcategory_products,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function childCategoryProducts($slug){
        $childCategory = Childcategory::with('products.category')->where('slug',$slug)->first();
        $childCategoryProduct = $childCategory->products;
        $product = $childCategoryProduct[0];
        
        $relatedProducts = $this->relatedProducts($product);

        return response()->json([
            'subCatProducts' => $childCategoryProduct,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    private function relatedProducts($product){
        $relatedProducts = Product::with('category','subcategory')->whereHas('tags', function ($q) use ($product) {
            return $q->whereIn('tag_name', $product->tags->pluck('tag_name')); 
        })
        ->where('id', '!=', $product->id) 
        ->get();
        return $relatedProducts;
    }
}
