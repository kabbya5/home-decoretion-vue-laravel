<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Subcategory;

class Childcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $date = ['created_at'];

    protected $appends = ['created_date'];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at ? $this->created_at->diffForHumans() :' ';
    }
}
