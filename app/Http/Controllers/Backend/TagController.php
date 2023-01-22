<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tag = Tag::with('image')->latest()->get();
        return response()->json($tag);
    }

    public function store(Request $request){
        
        $request->validate([
            'tag_name' => 'required|min:5|max:250',
            'image_id' => 'required|max:1',
            'popularity' => 'integer',
        ]);
        
        Tag::create([
            'tag_name' => $request->tag_name,
            'slug'     => str_slug($request->tag_name),
            'image_id' => $request->image_id[0],
            'popularity' => $request->popularity,
        ]);

    }
    
    public function update(Request $request,$id){
        $tag = Tag::where('id',$id)->first();
        $request->validate([
            'tag_name' => 'required|min:5|max:250|unique:tags,tag_name,'.$tag->id,
            'image_id' => 'required|max:1',
            'popularity' => 'integer',
        ]);
        $tag->update([
            'tag_name' => $request->tag_name,
            'slug'     => str_slug($request->tag_name),
            'image_id' => $request->image_id[0],
            'popularity' => $request->popularity,
        ]);

    }

    public function delete($id)
    {
        Tag::where('id',$id)->delete();
    }
}
