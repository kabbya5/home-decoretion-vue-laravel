<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Slider;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopPageContents(){
        $categories = Category::with('products')->orderBy('view_count','desc')->get();
        $popularProducts = Product::orderBy('view_count','desc')->limit(15)->get();
        return response()->json([
            'categories' => $categories,
            'popularProducts' => $popularProducts,
        ]);
    }

    public function shopPageProducts($status){
        if($status == 'all'){
            $prdoucts = Product::OrderBy('view_count','desc')->take(50)->with('category')->get();

            $relatedProducts = Product::OrderBy('top_rated','desc')->take(12)->with('category')->get();
        }

        return response()->json([
            'products' => $prdoucts,
            'relatedProducts' => $relatedProducts,
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

    public function sliderProduct($slug){
        $slider = Slider::with('products.category')->where('slug',$slug)->first();
        $sliderProduct = $slider->products;
        $product = $sliderProduct[0];

        $relatedProducts = $this->relatedProducts($product);

        return response()->json([
            'sliderProducts' => $sliderProduct,
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
