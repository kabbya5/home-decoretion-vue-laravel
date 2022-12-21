<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Wishlist extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $date = ['created_at'];

    protected $appends = ['created_date'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
