<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}