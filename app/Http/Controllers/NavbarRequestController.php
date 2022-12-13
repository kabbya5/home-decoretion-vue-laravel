<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Tag;
use Illuminate\Http\Request;

class NavbarRequestController extends Controller
{
    public function getNavbarCategory(){

        $categories = Category::with('subcategories.childcategories')->orderBy('viewCount', 'desc')->get();
        return response()->json($categories);
    }

    public function getSiteSetting(){
        $siteSetting = SiteSetting::first();
        return response()->json($siteSetting);
    }
    function searchTags(Request $request)
    {
        $tags = Tag::with('image')->where('tag_name','LIKE', '%' .$request->searchTag . '%')->get();
        return response()->json($tags);
    }
}
