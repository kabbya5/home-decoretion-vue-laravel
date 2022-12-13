<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Image extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['date',];

    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function products(){
        return $this->morphedByMany(Product::class,'imagable');
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }
}

