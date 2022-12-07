<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Image;
use Carbon\Carbon;
use DB;
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['published_at'];
    protected $appends = ['date','sale_status','discount_status_or_new',];

    public function sizes(){
        return $this->belongsToMany(Size::class,'product_size');
    }

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
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

    public function getDateAttribute(){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }
    //product status top sale of sole out

    public function getSaleStatusAttribute(){
        if($this->quantity > 0){
            if($this->top_rated || $this->is_weekly_sale){
                $sale_status = 'best sale';
            }
        }else{
            $sale_status = 'sole out';
        }
        return $sale_status;
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
    // public function getImageUrlAttribute() {
    //     $id = DB::table('imagebles')->where('imageble_id', $this->id)->where('imageble_type','App\Models\Product')->first()->id;
    //     $image_id = $id->image_id;
    //     $image = DB::table('images')->where('id' ,$image_id)->first();
    //     return $image;
    // }
}
