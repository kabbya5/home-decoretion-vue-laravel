<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Childcategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = ['date','img'];

    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function products(){
        return $this->morphedByMany(Product::class,'imageble');
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function childcategory(){
        return $this->hasMany(Childcategory::class);
    }

    public function getImgAttribute(){
        return '/'.$this->product_img;
    }
}

