<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\CategoryNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Image;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::with('category','childcategories','products')->latest()->get();
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
            'subcat_img' => 'required',
        ],[
           'category_id.required' => "Category name is required",
           'subcat_img.required' => "Subcategory Image is required" 
        ]);

        $input = $this->handelRequest($request);
        $input['slug'] = $input['subCatName'];

        try{
            Category::findOrFail($input['category_id']);
            Subcategory::create($input);


        }catch (ModelNotFoundException $e){
            throw new CategoryNotFoundException();
        }
    }
    private function  handelRequest($request){

        $input = $request->all();


        if($request->subcat_img){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->subcat_img, ';');
            $sub = substr($request->subcat_img, 0, $position);
            $ext = explode('/',$sub)[1];

            $temName = $this->subcatImageName(); 
            $subcat_imgName = $temName. '.' .$ext;

            Image::make($request->subcat_img)->resize(400,300)->save(
                public_path('/media/subcategory/') . $subcat_imgName
            );
   
            $input['subcat_img'] = "media/subcategory/" . $subcat_imgName;
        }
        $input['slug'] = str_slug($input['subCatName']);
        unset($input['oldImg']);

        return $input;
    }

    private function deleteOldImg($oldImg){ 
        if(file_exists($oldImg)){
            unlink($oldImg);
        }  
    }

    private function subcatImageName(){
        $charectere = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';
        $number = '123456789';
        $newCharecter = explode(',',$charectere);
        $charectere = implode('',$newCharecter);
        $char = '';
        
        for($i=1; $i <= 10;$i++){
          if($i <6){
            $char .= $charectere[rand(0,25)];
          }elseif($i<=9 && $i >= 5){
            $char .= $number[rand(0,8)];
          }elseif($i == 10){
            $char .= $charectere[rand(0,25)];
          }
        }     
        return $char;
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'subCatName' => 'required|unique:subcategories,subCatName,'.$id,
            'category_id' => 'required',
        ]);
        $data =  $this->handelRequest($request);
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
        
        $subcategory = Subcategory::withTrashed()->where('id',$id)->firstOrFail();
        $this->deleteOldImg($subcategory->subcat_img);
        $subcategory->forceDelete();
    }

}
