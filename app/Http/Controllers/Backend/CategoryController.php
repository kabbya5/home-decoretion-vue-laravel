<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->uploadPath = public_path('/media/category/');
    }

    public function index()
    {
        $categories = Category::orderBy('viewCount','DESC')->get();
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
        dd($data['categoryImg']);
        // Category::create($data);
    }

    private function  handelRequest($request){

        $input = $request->all();
        $input['slug'] = $input['categoryName']; 
        unset($input['oldImg']);

        if($request->hasFile('categoryImg')){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->categoryImg, ';');
            $sub = substr($request->categoryImg, 0, $position);
            $ext = explode('/',$sub)[1];

            $input['categoryImg'] = $ext;
            $temName = $this->categoryImageName(); 
            $categoryImgName = $temName. '.' .$ext;

            // Image::make($request->categoryImg)->resize(500,500)->save(
            //     $this->uploadPath . $categoryImgName
            // );
   
            // $input['categoryImg'] = "media/category/" . $categoryImgName;
        }
        $input['slug'] = $input['categoryName'];

        return $input;
    }

    private function deleteOldImg($oldImg){
        unlink($oldImg);
    }

    private function categoryImageName(){
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
