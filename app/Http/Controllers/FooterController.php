<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(){
        $pages = Page::orderBy('popularity','DESC')->get();
        $socialLinks = SocialMedia::all();
        return response()->json([
            'pages' => $pages,
            'socialLinks' => $socialLinks,
        ]);
    }
}
