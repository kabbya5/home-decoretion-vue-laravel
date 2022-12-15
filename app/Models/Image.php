<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = ['date',];

    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function products(){
        return $this->morphedByMany(Product::class,'imageble');
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }
}

