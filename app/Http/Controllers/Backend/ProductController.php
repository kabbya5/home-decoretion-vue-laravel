<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductImage;
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

    //  public function __construct()
    //  {
    //     $this->middleware('auth:api');
    //  }
    public function index()
    {
        //
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
        $images = ProductImage::latest()->get();
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
        // $data = $request->all();

        $seller_id = auth()->user()->id;
        return response()->json($seller_id);
        // $data['seller_id'] = $seller_id;
        // $data['slug'] = str_slug($data['product_title']);



        // $tags = $data['tags'];
        // $images = $data['images'];
        // $sizes = $data['sizes'];
        // $colors = $data['colors'];
        
        // unset($data['tags']);
        // unset($data['images']);
        // unset($data['sizes']);
        // unset($data['colors']);
        
        // $product = Product::create($data);

        // $product->tags()->attach($tags);
        // $product->images()->attach($images);
        // $product->sizes()->attach($sizes);
        // $product->colors()->attach($colors);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function update $request, Product $product)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
