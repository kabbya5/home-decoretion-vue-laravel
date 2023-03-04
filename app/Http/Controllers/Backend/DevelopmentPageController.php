<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Developmentpagetitle;
use Illuminate\Http\Request;
use Image;

class DevelopmentPageController extends Controller
{

    public function titleIndex(){
        $page = Developmentpagetitle::first();
        return response()->json($page);
    }
    public function storeTitle(Request $request){
        $request->validate([
            'page_name' => 'required',
            'background_image' => 'required'
        ]);

        $data['page_name'] = $request->input('page_name');
        $data['background_image'] = $this->handelRequest($request->background_image,'bg_img',false); 

        Developmentpagetitle::create($data);

    }

    private function  handelRequest($img,$image_type,$old_img){
        if($img){
            if($old_img){
                $this->deleteOldImg($old_img);
            }
            $position = strpos($img, ';');
            $sub = substr($img, 0, $position);
            $ext = explode('/',$sub)[1];

            $tempName = $this->imageName(); 
            $image_name = $tempName. '.' .$ext;

            
            if($image_type == 'bg_img'){
                $img = Image::make($img)->resize(800,1400); 
            }

            $img->save(public_path('/media/page/') . $image_name);
            return  "/media/page/" . $image_name;
        }
        
    }

    private function imageName(){
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
    private function deleteOldImg($oldImg){
        $oldImg = ltrim($oldImg,'/'); 
        if(file_exists($oldImg)){   
            unlink($oldImg);
        }
    }

    public function titleUpdate(Request $request,$id){
        $pageTitle = Developmentpagetitle::find($id);
        $request->validate([
            'page_name' => 'required',
        ]);

        $data['page_name'] = $request->input('page_name');
        $data['background_image'] = $this->handelRequest($request->background_image,'bg_img',$request->old_background_image); 

        $pageTitle->update($data);
    }
}
