<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class welcomeController extends Controller
{
    public function index(){
        /*$issues = [
            ['title' => 'PHP lovers'],
            ['title' => 'Rails and laravel']
        ];*/

        //跳过1条取两条
        $issues = Issue::orderBy('created_at','desc')->skip(0)->take(2)->get();

        return view('welcome.index')->with('issues',$issues);
    }
    public function about(){
        return view('welcome.about');
    }

}
