<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {

        $this->uploadPath = public_path('/media/category/');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        $count = $categories->count();

        if($count > 1){
            $categoriesCount = $count . '  '.'categories';
        }else{
            $categoriesCount = $count . '  '. 'category';
        }
        
        return response()->json([$categories,$categoriesCount]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $this->handelRequest($request);
        Category::create($data);
    }

    private function  handelRequest($request){

        $input = $request->all();
        $input['slug'] = $input['categoryName']; 
        unset($input['oldImg']);

        if($request->categoryImg){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->categoryImg, ';');
            $sub = substr($request->categoryImg, 0, $position);
            $ext = explode('/',$sub)[1];

            $input['categoryImg'] = $ext;
            $temName = $this->categorycategoryName(); 
            $categoryImgName = $temName. '.' .$ext;

            Category::make($request->categoryImg)->resize(400,300)->save(
                $this->uploadPath . $categoryImgName
            );
   
            $input['categoryImg'] = "/media/category/" . $categoryImgName;
        }
        $input['slug'] = str_slug($input['categoryName']);
        $input['categoryImgName'] = str_slug($input['categoryName']);

        return $input;
    }

    private function deleteOldImg($oldImg){
        unlink($oldImg);
    }

    private function categorycategoryName(){
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

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $data = $this->handelRequest($request);
        $category->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category  $category)
    {
        $category->delete();
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();
    }

    public function trashed()
    {
        $trashedCategory = Category::onlyTrashed()->latest()->get();
        $count = $trashedCategory->count();
        if($count > 1){
            $trashedCategoryCount = $count . '  '.'Category';
        }else{
            $trashedCategoryCount = $count . '  ' .'Category';
        }

        return response()->json([$trashedCategory, $trashedCategoryCount]);
    }

    public function forceDelete($id){
        $category = Category::withTrashed()->findOrFail($id);
        $this->deleteOldImg($category->categoryImg);
        $category->forceDelete();   
    }
}
