<?php

namespace App\Http\Controllers;

use App\Models\Category;

class NavbarRequestController extends Controller
{
    public function getNavbarCategory(){

        $categories = Category::with('subcategories.childcategories')->orderBy('viewCount', 'desc')->get();
        return response()->json($categories);
    }
}
