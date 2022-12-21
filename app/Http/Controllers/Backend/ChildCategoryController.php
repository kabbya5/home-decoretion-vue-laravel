<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Childcategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    
    public function index()
    {
        $childcateogries = Childcategory::with('products','subcategory.category')->latest()->get();
        return response()->json($childcateogries);
    }

    public function store(Request $request)
    {
        $request->validate([
            'childCatName' => 'required|unique:childcategories',
            'subcategory_id' => 'required',
        ]);
        $data = $request->all();
        $data['slug'] = str_slug($data['childCatName']);

        Childcategory::create($data);
    }

    public function update(Request $request, Childcategory $childcategory)
    {
        $childcategory->update(
            $request->validate([
                'childCatName' => 'required|unique:childcategories,childCatName,'.$childcategory->id,
                'subcategory_id' => 'required',
            ]) + ['slug' => str_slug($request->childCatName)
        ]);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Childcategory $childcategory)
    {
        $childcategory->delete();
    }
}
