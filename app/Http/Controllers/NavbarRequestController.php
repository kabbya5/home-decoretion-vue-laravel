<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Tag;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Cart;
use Auth;

class NavbarRequestController extends Controller
{
    public function getNavbarCategory(){

        $categories = Category::with('subcategories.childcategories')->orderBy('viewCount', 'desc')->get();
        return response()->json($categories);
    }

    public function getNavbarContents(){
        $siteSetting = SiteSetting::first();

        $cart = [];
        $cart['subtotal'] = Cart::subtotal();
        $cart['count'] = Cart::count();

        if(Auth::check()){
            $wishlistCount = Wishlist::where('user_id',Auth::id())->latest()->get()->count();
            $user = Auth::user();
        }else{
            $wishlistCount = 0;
            $user = null;
        }

        return response()->json([
            'cart' => $cart,
            'siteSetting' => $siteSetting,
            'wishlistCount' => $wishlistCount,
            'user' => $user,
        ]);
        return response()->json($siteSetting);
    }

    function searchTags(Request $request)
    {
        $tags = Tag::with('image')->where('tag_name','LIKE', '%' .$request->searchTag . '%')->get();
        return response()->json($tags);
    }

}
