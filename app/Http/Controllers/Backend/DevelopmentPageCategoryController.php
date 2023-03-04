<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DevelopmentPageCategory;
use Illuminate\Http\Request;

class DevelopmentPageCategoryController extends Controller
{
    public function index(){
        return response()->json(DevelopmentPageCategory::latest()->orderBy('view_counts','DESC')->get());
    }

    public function store(Request $request){
        DevelopmentPageCategory::create(
            $request->validate([
                'categoryName' => 'required|min:20|max:200|unique:development_page_categories,categoryName',
                'categoryText' => 'max:500',
            ]) + ['slug' => str_slug($request->categoryName)]
        );

    }

    public function update(Request $request,DevelopmentPageCategory $category){
        $request->validate([
            'categoryName' => 'required|min:20|max:200|unique:development_page_categories,categoryName,'.$category->id,
            'categoryText' => 'max:500',
        ]);

        $data = $request->all();
        $data['slug'] = str_slug($data['categoryName']);

        $category->update($data);
    }
}
