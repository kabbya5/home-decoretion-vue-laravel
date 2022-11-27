<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Tag;

class ProductImage extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];
    protected $appends = ['date',];

    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function products(){
        return $this->morphedByMany(Product::class,'imagable');
    }

    public function tag(){
        return $this->morphOne(Tag::class,'imagable');
    }
}
