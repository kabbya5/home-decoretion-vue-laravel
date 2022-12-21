<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipping;
use App\Models\OrderDetails;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $date = ['created_at'];
    protected $appends = ['created_date'];

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    public function shipping(){
        return $this->hasOne(Shipping::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
