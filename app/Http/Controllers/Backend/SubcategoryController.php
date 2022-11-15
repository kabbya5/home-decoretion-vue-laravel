<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\CategoryNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->get();
        $count = $subcategories->count();
        if($count > 1){
            $subcategoriesCount = $count . '  '.'subcategories';
        }else{
            $subcategoriesCount = $count . '  ' .'subcategory';
        }

        return response()->json([$subcategories,$subcategoriesCount]);
    }

    public function trashed()
    {
        $subcategories = Subcategory::with('category')->onlyTrashed()->latest()->get();
        $count = $subcategories->count();
        if($count > 1){
            $subcategoriesCount = $count . '  '.'subcategories';
        }else{
            $subcategoriesCount = $count . '  ' .'subcategory';
        }

        return response()->json([$subcategories,$subcategoriesCount]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'subCatName' => 'required|min:3|max:250|unique:subcategories,subCatName',
            'category_id' => 'required',
        ]);

        $input = $request->all();
        $input['slug'] = $input['subCatName'];

        try{
            Category::findOrFail($input['category_id']);
            Subcategory::create($input);


        }catch (ModelNotFoundException $e){
            throw new CategoryNotFoundException();
        }
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'subCatName' => 'sometimes|unique:subcategories',
            'category_id' => 'required',
        ]);
        $data = $request->all();
        Subcategory::findOrFail($id)->update($data);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
    }
    public function restore($id){
        $subcategory = Subcategory::withTrashed()->findOrFail($id);
        $subcategory->restore();
    }

    public function forceDelete($id){
       Subcategory::where('id', $id)->forceDelete();
    }

}
