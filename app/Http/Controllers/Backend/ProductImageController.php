<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = \App\Models\Image::with('products')->latest()->get();


        return response()->json([
            'allImages' => $images,
            'imageCount' => $images->count() .' '. 'images',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_img_name' => 'required|min:4|max:120',
            'product_img' =>'required',
        ]);
        $data = $this->handelRequest($request);

        \App\Models\Image::create($data);
        return response()->json($data);
    }
    private function  handelRequest($request){

        $input = $request->all();
        unset($input['oldImg']);

        if($request->product_img){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->product_img, ';');
            $sub = substr($request->product_img, 0, $position);
            $ext = explode('/',$sub)[1];

            $tempName = $this->productImageName(); 
            $productImgName = $tempName. '.' .$ext;

            $img = Image::make($request->product_img)->resize(200,200);

            $img->save(public_path('/media/product/') . $productImgName);
            $input["product_img"] = "/media/product/" . $productImgName;
        }  
        return $input;
    }

    
    private function productImageName(){
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


    public function update(Request $request,\App\Models\Image $productImage )
    {
        $request->validate([
            'product_img_name' => 'required|min:4|max:120',
        ]);
        $data = $this->handelRequest($request);
        $productImage->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\Image $productImage)
    {
        $productImage->delete();
    }

    public function restore($id)
    {
        $image = \App\Models\Image::withTrashed()->findOrFail($id);
        $image->restore();

    }

    public function trashed()
    {
        $trashedImages = \App\Models\Image::onlyTrashed()->latest()->get();
        $count = $trashedImages->count();
        if($count > 1){
            $trashedImagesCount = $count . '  '.'productImage';
        }else{
            $trashedImagesCount = $count . '  ' .'productImage';
        }

        return response()->json([$trashedImages, $trashedImagesCount]);
    }

    public function forceDelete($id){
        $image = \App\Models\Image::withTrashed()->findOrFail($id);
        $this->deleteOldImg($image->product_img);
        $image->forceDelete();   
    }

    private function deleteOldImg($oldImg){
        $oldImg = ltrim($oldImg,'/'); 
        if(file_exists($oldImg)){
            unlink($oldImg);
        }  
    }
}
