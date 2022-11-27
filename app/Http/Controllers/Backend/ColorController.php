<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller

{
    public function index(){
        $colors = Color::latest()->get();
        $count = count($colors);
        if($count > 1){
            $colorsCount = $count . '  '.'colors';
        }else{
            $colorsCount = $count . '  '.'color';
        }
        return response()->json([$colors,$colorsCount]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);
        $data = $request->all();
        Color::create($data);
    }

    public function update(Request $request,Color $color)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);
        $data = $request->all();

        $color->update($data);
    }
}
