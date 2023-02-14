<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function index(){
        $pages = Page::orderBy('popularity','DESC')->get();
        return response()->json($pages);
    }

    public function store(Request $request){
        Page::create($request->validate([
            'page_title' => 'required|unique:pages,page_title',
            'page_content' => 'required|min:500|',
            'popularity' => 'integer',
        ])+['slug' => str_slug($request->page_title)]);
    }

    public function update(Request $request,Page $page){
        $page->update($request->validate([
            'page_title' => 'required|unique:pages,page_title,'.$page->id,
            'page_content' => 'required|min:500|',
            'popularity' => 'integer',
        ])+['slug' => str_slug($request->page_title)]);
    }

    public function show($slug){
        $page = Page::where('slug',$slug)->first();
        return response()->json($page);
    }
}
