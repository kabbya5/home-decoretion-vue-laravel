<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function tag(){
        return $this->morphOne(Tag::class,'imagable');
    }
}

