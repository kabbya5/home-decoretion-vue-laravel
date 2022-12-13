<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Subcategory;

class Childcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
