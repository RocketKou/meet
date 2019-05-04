<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'require|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {

        //return $request->file;   //C:\Users\Administrator\AppData\Local\Temp\php1E35.tmp


       /*
        $path = $request->file->store('public/images');
        return $path;    //此时就已经存储到框架里了  public/images/U91ske4Vjr7UaiEFVVGIh6VijVtVOvB1ZhE5Mlhb.jpeg
        */

        //验证文件是否上传
        if(!$request->hasFile('file'))
            return response()->json(['message'=>'上传的文件为空'],422);

        //验证文件格式是否正确
        if(!$request->file->isValid())
            return response()->json(['message'=>'上传过程出错'],422);

        //上传格式验证
        $allow = ['image/jpeg','images/png','images/gif'];
        $type = $request->file->getMimeType();

        if(!in_array($type,$allow))
            return response()->josn(['message'=>'上传格式出错'],422);

        //文件大小验证
        $max_size = 1024 * 1024 * 20;
        $fils_size = $request->file->getClientSize();

        if($fils_size > $max_size)
            return response()->json(['message'=>'上传文件不能超过20M'],422);


        //大写带包返回值中不存在，但确实是该目录下的文件
        $path = $request->file->store('public/images');//  STORAGE/IMAGES/public/images/85Bu7K5Cfj898QRfEZ6nJtYaB77g6xc84S3fjWKG.jpeg
        $url = Storage::url($path);                    //  /storage/images/PUBLIC/STthooLuzDcF7xhQdFQLnC7x0F8q0FHk4kbhkBLf.jpeg
        return $url;
    }
}
