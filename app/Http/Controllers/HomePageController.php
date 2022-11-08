<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function getCategory(){
        $categories = Category::orderBy('viewCount','DESC')->get();
        $firstCategory = $categories[0];
        $categories = $categories->skip(1)->all();

        return response()->json([$firstCategory,$categories]);
    }
}
