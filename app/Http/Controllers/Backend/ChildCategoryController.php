<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Childcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    
    public function index()
    {
        $childcateogries = Childcategory::with('products','subcategory.category','image')->latest()->get();
        return response()->json($childcateogries);
    }

    public function store(Request $request)
    {
        $request->validate([
            'childCatName' => 'required|unique:childcategories',
            'subcategory_id' => 'required',
            'image_id' => 'required',
        ],[
            'image_id.required' => "the image field is required !",
            'subcategory_id.required' => "the subcategory field is required !",
        ]);
        $data = $request->except('image_id');
        $data['image_id'] = $request->image_id[0];
        $data['slug'] = str_slug($data['childCatName']);

        Childcategory::create($data);
    }

    public function update(Request $request, Childcategory $childcategory)
    {
        $request->validate([
            'childCatName' => 'required|unique:childcategories,childCatName,'.$childcategory->id,
            'subcategory_id' => 'required',
            'image_id' => 'required',
        ],[
            'image_id.required' => "the image field is required !",
            'subcategory_id.required' => "the subcategory field is required !",
        ]); 

        $data = $request->except('image_id');
        $data['image_id'] = $request->image_id[0];
        $data['slug'] = str_slug($data['childCatName']);

        $childcategory->update($data);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Childcategory $childcategory)
    {
        foreach($childcategory->products as $product){
            $product = Product::where('id',$product->id);
            $product->update([
                'childcategory_id' => NULL,
            ]);
        }
        $childcategory->delete();
    }
}
