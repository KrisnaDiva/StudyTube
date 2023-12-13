<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $with=['user','course'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function links(){
        return $this->hasMany(Link::class);
    }
}
