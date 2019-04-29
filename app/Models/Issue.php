<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['title','content'];

    //因为是一对多所以comment写负数
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
