<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['published_at'];
    protected $appends = ['published_date'];

    public function getPublishedDateAttribute(){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
