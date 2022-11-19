<?php

Namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function index()
    {
     $sliders = Slider::latest()->get();
        $count = $sliders->count();
        if($count >1){
         $sliderCount = $count .'  '. 'Sliders';
        }else{
         $sliderCount = $count .'  ' . 'Slider';
        }
        return response()->json( [$sliders, $sliderCount]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'sliderName' => 'required|unique:Sliders',
            'sliderImg'  => 'required',
        ]);
        $data = $this->handelRequest($request);
        Slider::create($data);
    }
    private function  handelRequest($request){

        $input = $request->all();
        $input['slug'] = $input['sliderName']; 
        unset($input['oldImg']);

        if($request->sliderImg){
            if($request->oldImg){
                $this->deleteOldImg($request->oldImg);
            }
            $position = strpos($request->sliderImg, ';');
            $sub = substr($request->sliderImg, 0, $position);
            $ext = explode('/',$sub)[1];
            $tempName = $this->sliderImgName(); 
            $sliderImageName = $tempName. '.' .$ext;

            $img = Image::make($request->sliderImg)->resize(900,700);

            $img->save(public_path('/media/slider/') . $sliderImageName);
            $input["sliderImg"] = "/media/slider/" . $sliderImageName;
        }
        $input['slug'] = $input['sliderName'];

        return $input;
    }

    private function deleteOldImg($oldImg){
        $oldImg = ltrim($oldImg,'/'); 
        unlink($oldImg);
    }

    private function sliderImgName(){
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

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'sliderName' => 'required|unique:Sliders,sliderName,' .$slider->id,
        ]);
        $data = $this->handelRequest($request);
        $slider->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $this->deleteOldImg ($slider->sliderImg);
        $slider->delete();
    }
}
