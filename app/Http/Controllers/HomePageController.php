<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;


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

    public function getHomePageContent(){
        $weekSaleProduct = Product::with('category','subcategory','childcategory','images')->weekSaleProduct()->limit(12)->get();

        $sliders = Slider::where('published_at','<=', Carbon::now())->get();

        $resentPrdouct = Product::with('category','subcategory','childcategory','images')->where('published_at','<=', Carbon::now())->latest()->take(12)->get();
       
        return response()->json([
           'sliders' => $sliders,
           'resentProducts' => $resentPrdouct,
           'bestWeekSaleproducts' => $weekSaleProduct,

        ]);
    } 
}
