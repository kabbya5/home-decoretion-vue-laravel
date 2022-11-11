<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Childcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
}