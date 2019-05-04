<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * 错误3次后
     * @var string
     */
    protected $maxAttempts = '3';

    /**
     * 禁止登陆1个小时
     * @var string
     */
    protected $decayMinutes = '60';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 重写AuthenticatesUsers里的validateLogin方法，增加验证码登陆
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request,[
            'captcha' => 'required|captcha',
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    /**
     * 重写AuthenticatesUsers里面的username方法，改变默认的邮箱登陆为username登陆
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }


}
