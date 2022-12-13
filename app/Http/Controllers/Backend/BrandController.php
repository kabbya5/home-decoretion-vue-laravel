<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        // $this->middleware('auth');
        //$this->uploadPath = public_path('/media/category/');
    }

    public function index()
    {
        $brands = Brand::latest()->get();
        $count = $brands->count();
        if($count >1){
            $brandCount = $count .'  '. 'brands';
        }else{
            $brandCount = $count .'  ' . 'brand';
        }
        return response()->json([$brands, $brandCount]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
        ]);
        $data = $this->handelRequest($request);
        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->brand_img = $data["brand_img"]; 
        
        $brand->save();
    }
    private function  handelRequest($request){

        $input = $request->all();
        $input['slug'] = str_slug($input['name']); 
        unset($input['oldImg']);

        if($request->brand_img){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->brand_img, ';');
            $sub = substr($request->brand_img, 0, $position);
            $ext = explode('/',$sub)[1];

            $tempName = $this->brandImageName(); 
            $brandImgName = $tempName. '.' .$ext;

            $img = Image::make($request->brand_img)->resize(200,200);

            $img->save(public_path('/media/brand/') . $brandImgName);
            $input["brand_img"] = "/media/brand/" . $brandImgName;
        }
        return $input;
    }

    private function deleteOldImg($oldImg){
        $oldImg = ltrim($oldImg,'/'); 
        unlink($oldImg);
    }

    private function brandImageName(){
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

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,'.$brand->id,
        ]);
        $data = $this->handelRequest($request);
        $brand->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->deleteOldImg($brand->brand_img);
        $brand->delete();
    }
}
