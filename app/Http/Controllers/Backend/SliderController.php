<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function getSliders()
    {
        $sliders = Slider::orderBy('viewCount', 'DESC')->get();
        $count = $sliders->count();

        if($count > 1){
            $sliderCount = $count . '  '.'sliders';
        }else{
            $sliderCount = $count . '  '. 'slider';
        }

        return response()->json([$sliders, $sliderCount]);
    }

    public function create(Request $request)
    {
        $req = $request->validate([
            'sliderName' => 'required|unique:sliders',
        ]);

        $position = strpos($request->sliderImg, ';');
        $sub = substr($request->sliderImg, 0, $position);
        $ext = explode('/',$sub)[1];
        dd($ext);
    }
}
