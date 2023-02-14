<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Tag;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Cart;
use Auth;

class NavbarRequestController extends Controller
{
    public function getNavbarCategory(){

        $categories = Category::with('subcategories.childcategories')->orderBy('view_count', 'desc')->get();
        return response()->json($categories);
    }

    public function getNavbarContents(){
        $siteSetting = SiteSetting::first();

        $cart = [];
        $cart['subtotal'] = Cart::subtotal();
        $cart['count'] = Cart::count();

        if(Auth::check()){
            $wishlistCount = Wishlist::where('user_id',Auth::id())->latest()->get()->count();
            $user = User::where('id', Auth::id())->first();

            foreach($user->unreadNotifications as $notification){
                $notification['created_data'] = $notification['created_at']->diffForHumans();
            }
            $notifications = $user->unreadNotifications->count();
        }else{
            $wishlistCount = 0;
            $user = null;
            $notifications = null;
        }
        return response()->json([
            'cart' => $cart,
            'siteSetting' => $siteSetting,
            'wishlistCount' => $wishlistCount,
            'user' => $user,
            'notification' => $notifications,
        ]);
        return response()->json($siteSetting);
    }

    function searchTags(Request $request)
    {
        $tags = Tag::with('image')->where('tag_name','LIKE', '%' .$request->searchTag . '%')
        ->where('popularity', '>', 0)->take(10)->get();
        return response()->json($tags);
    }

}
