<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Image;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Size;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $authId;

     public function __construct()
     {
        $this->authId = Auth::id();
     }
    public function index()
    {
        if(Auth::user()->is_admin === 2){
            $products = Product::with('images','category')->where('seller_id', $this->authId)->orderBy('published_at','DESC')->get();
        }else{
           $products = Product::with('images','category')->orderBy('published_at','DESC')->get();
        }

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorties = Category::with('subcategories.childcategories')->latest()->get();
        $brands = Brand::latest()->get();
        $sliders = Slider::latest()->get();
        $tags = Tag::latest()->get();
        $images = Image::latest()->get();
        $sizes = Size::latest()->get();
        $colors = Color::latest()->get();

        return response()->json([
            $categorties,
            $brands,
            $sliders,
            $tags,
            $images,
            $sizes,
            $colors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();
        $seller_id = auth()->user()->id;
        $data['seller_id'] = $seller_id;
        $data['slug'] = str_slug($data['product_title']);



        $tags = $data['tags'];
        $images = $data['images'];
        $sizes = $data['sizes'];
        $colors = $data['colors'];
        
        unset($data['tags']);
        unset($data['images']);
        unset($data['sizes']);
        unset($data['colors']);
        
        $product = Product::create($data);

        $product->tags()->attach($tags);
        $product->images()->attach($images);
        $product->sizes()->attach($sizes);
        $product->colors()->attach($colors);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug',$slug)->first();
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::withTrashed()->where('slug',$slug)->first();
        $imgs = [];
        $sizes = [];
        $colors = [];
        $tags = [];

        foreach($product->images as $image){
            array_push($imgs,$image->id);
        }

        foreach($product->sizes  as $size){
            array_push($sizes ,$size->id);
        }

        foreach($product->colors as $color){
            array_push($colors ,$color->id);
        }

        foreach($product->tags as $tag){
            array_push($tags,$tag->id);
        }

        return response()->json([
            'product' => $product,
            'product_images' => $imgs,
            'product_sizes' => $sizes,
            'product_tags' => $tags,
            'product_colors' => $colors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update (ProductStoreRequest $request,Product $product)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['product_title']);

        $tags = $data['tags'];
        $images = $data['images'];
        $sizes = $data['sizes'];
        $colors = $data['colors'];
        
        unset($data['tags']);
        unset($data['images']);
        unset($data['sizes']);
        unset($data['colors']);

        $product->update($data);

        $product->tags()->sync($tags);
        $product->images()->sync($images);
        $product->sizes()->sync($sizes);
        $product->colors()->sync($colors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->first();
        $product->delete();
    }

    public function restore($id){
        Product::where('id',$id)->withTrashed()->restore();
    }

    public function trashed(){
        $products = Product::with('category','images')->onlyTrashed()->get();
        return response()->json($products);
    }
}
