<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $data = ['created_at'];

    protected $appends = ['created_date'];

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
