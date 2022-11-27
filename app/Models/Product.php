<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Size;
use App\Models\Tag;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function sizes(){
        return $this->belongsToMany(Size::class,'product_sizes');
    }

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function images(){
        return $this->morphedByMany(ProductImage::class,'imagable');
    }

    public function colors(){
        return $this->belongsToMany(Color::class,'product_colors');
    }
}
