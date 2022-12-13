<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Image;

class Tag extends Model
{
    use HasFactory;

    protected $appends = ['date',];

    protected $guarded = [];

    public function products(){
        return $this->morphedByMany(Product::class,'taggable');
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }

    public function getDateAttribute()
    {
       return $this->created_at ?  $this->created_at->diffForHumans() : '';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
