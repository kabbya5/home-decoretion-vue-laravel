<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subcategory;
use App\Models\Product;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
