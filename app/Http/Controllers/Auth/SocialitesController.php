<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialitesController extends Controller
{
    //跳转到QQ授权页面
    public function qq()
    {
        return Socialite::with('qq')->redirect();
    }

    //用户授权后，跳转回来
    public function callback()
    {
        $info = Socialite::driver('qq')->user();
        dump($info);
    }
}
