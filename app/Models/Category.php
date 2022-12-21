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

    protected $data =['created_at'];

    protected $appends = ['created_date'];

    protected $guarded = [];

    function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
