<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DevelopmentPageValue;
use Illuminate\Http\Request;

class DevelopmentPageValueController extends Controller
{
    public function index(){
        return response()->json(DevelopmentPageValue::orderBy('position','asc')->get());
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'icon'  => 'required',
            'section_type' => 'required',
            'description' => 'required|min:100|max:200',
            'position' => 'required|integer',
        ]);

        $data = $request->all();

        DevelopmentPageValue::create($data);
    }
}
