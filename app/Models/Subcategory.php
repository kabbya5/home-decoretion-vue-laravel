<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['date','img'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function childcategories(){
        return $this->hasMany(Childcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getImgAttribute(){
        return '/'.$this->subcat_img;
    }
}
