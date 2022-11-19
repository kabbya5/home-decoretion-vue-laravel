<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
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
        $productImages = ProductImage::latest()->get();
        $count = $productImages->count();
        if($count >1){
            $productImageCount = $count . '  '. 'product images';
        }else{
            $productImageCount = $count . '  '. 'product image';
        }

        return response()->json([$productImages, $productImageCount]);
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
        ]);
        $data = $this->handelRequest($request);

        ProductImage::create($data);
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

    private function deleteOldImg($oldImg){
        $oldImg = ltrim($oldImg,'/'); 
        unlink($oldImg);
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


    public function update(Request $request,ProductImage $productImage )
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
    public function destroy(ProductImage $productImage)
    {
        $productImage->delete();
    }

    public function restore($id)
    {
        $image = ProductImage::withTrashed()->findOrFail($id);
        $image->restore();

    }

    public function trashed()
    {
        $trashedImages = ProductImage::onlyTrashed()->latest()->get();
        $count = $trashedImages->count();
        if($count > 1){
            $trashedImagesCount = $count . '  '.'productImage';
        }else{
            $trashedImagesCount = $count . '  ' .'productImage';
        }

        return response()->json([$trashedImages, $trashedImagesCount]);
    }

    public function forceDelete($id){
        $image = ProductImage::withTrashed()->findOrFail($id);
        $this->deleteOldImg($image->product_img);
        $image->forceDelete();   
    }
}