<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public $aMeet = '测试问题一：此处是开发者A的修改部分';

    public $cMeet = '
    测试问题三：
    此时远端已经是B的最新提交了，如果开发者A修改了没有pull就提交会怎样
    ';


    protected $fillable = ['issue_id','name','email','content'];


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
