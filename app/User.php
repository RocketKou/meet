<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public $avatar;

    /**
     * 用户和活动表 一对多
     * @var
     */
    public function issues(){
        $this->hasMany('App\Models\Issue');
    }

    /**
     * 用户和评论表，一对多
     */
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }


    /**
     * 用户头像
     * @return mixed|string
     */
    public function avatar()
    {
        return $this->avatar ? $this->avatar : "https://www.gravatar.com/avatar/" . md5(strtolower($this->email)) . "?d=retro&s=48";
    }
}
