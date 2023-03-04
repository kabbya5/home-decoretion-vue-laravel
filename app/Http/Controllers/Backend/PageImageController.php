<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Developmentpageimage;
use Illuminate\Http\Request;
use Image;

class PageImageController extends Controller
{
    public function index()
    {
        $images = Developmentpageimage::latest()->get();


        return response()->json([
            'allImages' => $images,
            'imageCount' => $images->count() .' '. 'images',
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'page_image_name' => 'required|min:4|max:120',
            'page_image' =>'required',
        ]);
        $data = $this->handelRequest($request);

        Developmentpageimage::create($data);
        return response()->json($data);
    }

    private function  handelRequest($request){

        $input = $request->all();
        unset($input['oldImg']);

        if($request->page_image){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->page_image, ';');
            $sub = substr($request->page_image, 0, $position);
            $ext = explode('/',$sub)[1];

            $tempName = $this->pageImageName(); 
            $pageImgName = $tempName. '.' .$ext;

            $img = Image::make($request->page_image)->resize(600,400);

            $img->save(public_path('/media/page/') . $pageImgName);
            $input["page_image"] = "/media/page/" . $pageImgName;
        }  
        return $input;
    }

    
    private function pageImageName(){
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


    public function update(Request $request,Developmentpageimage $developmentpageimage)
    {
        $request->validate([
            'page_image_name' => 'required|min:4|max:120',
        ]);
        $data = $this->handelRequest($request);
        $developmentpageimage->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pageImage  $developmentpageimage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developmentpageimage $developmentpageimage)
    {
        $this->deleteOldImg($developmentpageimage->page_image);
        $developmentpageimage->delete();
    }

    private function deleteOldImg($oldImg){
        $oldImg = ltrim($oldImg,'/'); 
        if(file_exists($oldImg)){
            unlink($oldImg);
        }  
    }
}
