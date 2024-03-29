<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developmentpageimage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['date',];

    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
