<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function aaa()
    {
        Comment::query()->toSql();
    }

    public function bbb()
    {
        Comment::find(1);
        
    }

    protected $fillable = ['issue_id','name','email','content'];

    public function ccc()
    {
        Comment::query()->orderBy()->where();

    }

    public function issue(){
        return $this->belongsTo('App\Models\Issue');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    //通过用户的email获取用户头像
    public function avatar()
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower($this->email)) . "?d=retro&s=48";
    }
}
