<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Childcategory;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['date',];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function childcategories(){
        return $this->hasMany(Childcategory::class);
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
