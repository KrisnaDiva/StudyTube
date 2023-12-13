<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $with=['post'];
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
