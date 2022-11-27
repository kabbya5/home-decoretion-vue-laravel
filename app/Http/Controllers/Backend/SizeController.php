<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    

    public function store(Request $request){
        $request->validate([
            'size_title' => 'required|max:250|unique:sizes',
            'size_extra_payment' => 'required|integer',
        ]);

        $data = $request->all();
        Size::create($data);
    }
}
