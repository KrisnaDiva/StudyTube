<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Monurakkaya\Lucg\Traits\HasUniqueCode;

class Course extends Model
{
    use HasFactory,HasUniqueCode;
    //composer require monurakkaya/laravel-unique-code-generator
    protected $guarded=['id'];
    protected $with=['teacher'];
    protected static function uniqueCodeLength()
    {
        return mt_rand(6,8);
    }
    public function teacher(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function students(){
        return $this->belongsToMany(User::class,'mycourses')->withPivot(["created_at","updated_at"]);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
