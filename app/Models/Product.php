<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use Carbon\Carbon;
use DB;
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['published_at'];
    protected $appends = [
        'published','category_name',
        'image_url','sale_status',
        'discount_status_or_new',
        'all_images',
        'product_sizes',
        'product_colors',
    ];

    public function sizes(){
        return $this->belongsToMany(Size::class,'product_size');
    }

    public function getCategoryNameAttribute(){
        return Category::where('id', $this->category_id)->first()->categoryName;
    }

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function getAllImagesAttribute(){
        $productImage = DB::table('imagebles')->where('imageble_id', $this->id)->where('imageble_type',"App\Models\Product")->get();
        $image_ids= [];
        foreach($productImage as $image){
            array_push($image_ids,$image->image_id);
        }

        $images = Image::whereIn('id',$image_ids)->get();
        return $productImage?$images:' ';
    }

    public function images(){
        return $this->morphToMany(Image::class, 'imageble');
    }

    public function colors(){
        return $this->belongsToMany(Color::class,'product_color');
    }

    public function slider(){
        return $this->belongsTo(SLider::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function childcategory(){
        return $this->belongsTo(Childcategory::class);
    }
    public function scopeWeekSaleProduct($query){
        return $query->where([
            ['published_at','<=', Carbon::now()],
            ['is_weekly_sale', 1],
            
        ])->orderBy('view_count', 'DESC');

    }

    public function scopePopular($query){
        return $query->where('view_count','DESC');
    }

    public function scopeTopRateded($query){
        return $query->where('top_rateded','desc');
    }

    public function seller(){
        return $this->belongsTo(User::class,'seller_id');
    }

    public function getRouteKeyName(){
        return "slug";
    }

    public function getPublishedAttribute(){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    //product status top sale of sole out

    public function getSaleStatusAttribute(){
        if($this->quantity > 0){
            if($this->top_rated || $this->is_weekly_sale){
                return 'best sale';
            }
        }else{
            return 'sole out';
        }
    }

    public function getDiscountStatusOrNewAttribute(){
        if($this->discount_price){
            $discount_price = $this->price - $this->discount_price;
            $discount_status_or_new = round($discount_price * 100 / $this->price) . "%";
        }else{
            $discount_status_or_new = "new";
        }
        return $discount_status_or_new;
    }
    public function getImageUrlAttribute() {
        
        $productImage = DB::table('imagebles')->where('imageble_id', $this->id)->where('imageble_type',"App\Models\Product")->first();
        
        if($productImage){
            $image_id = $productImage->image_id;
            $image = DB::table('images')->where('id' ,$image_id)->first()->product_img;
        }else{
            return '';
        }
       
        return $image;
    }

    public function getProductSizesAttribute(){
        $productSizes = DB::table('product_size')->where('product_id',$this->id)->get();
        $size_ids = [];
        foreach($productSizes as $size){
            array_push($size_ids,$size->size_id);
        }
        $sizes = Size::whereIn('id',$size_ids)->get();
        return $sizes?$sizes:' ';
    }
    public function getProductColorsAttribute(){
        $productSizes = DB::table('product_color')->where('product_id',$this->id)->get();
        $color_ids = [];
        foreach($productSizes as $color){
            array_push($color_ids,$color->color_id);
        }
        $color = Color::whereIn('id',$color_ids)->get();
        return $color?$color:' ';
    }
}
