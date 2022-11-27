<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Modles\ProductImage;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(){
        return $this->morphedByMany(Product::class,'taggable');
    }

    public function image(){
        return $this->morphOne(ProductImage::class,'imagable');
    }
}
