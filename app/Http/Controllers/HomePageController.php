<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function getCategory($width){
        $all_categories = Category::orderBy('viewCount','DESC')->get();
        $firstCategory = $all_categories[0];
        $categories = $all_categories->skip(1)->all();
        if($width < 768 || $width >= 1280){
            $show_cateogries = $all_categories->skip(1)->take(8);
        }else{
            $show_cateogries = $all_categories->skip(1)->take(7);
        }
        

        return response()->json([
            'firstCategory'  => $firstCategory,
            'categories' => $categories,
            'showCategories' => $show_cateogries,
        ]);
    }

    public function weekSaleProduct(){
        $product = Product::with('category','images')->weekSaleProduct()->limit(12)->get();
        return response()->json($product);
    }

    public function getSliders(){
        $sliders = Slider::where('published_at','<=', Carbon::now())->get();
        return response()->json($sliders);
    }

    
}
