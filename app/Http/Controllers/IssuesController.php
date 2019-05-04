<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Issue;
use Illuminate\Support\Facades\Auth;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::orderBy('created_at','DESC')->paginate(5);
        return view('issues.index')->with('issues',$issues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //判断当前用户是否登录
        if(!Auth::check())
//            return response()->json(['message' => '登录后才有权限',422]);
            return redirect('/')->with('notice','未登录用户没有权限发布活动');

        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //增加隐藏字段user_id
        Issue::create($request->all());
        return redirect('/')->with('notice','增加成功了');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
    public function show(Issue $issue)
    {
//        $issue = Issue::find($id);
        $comments = $issue->comments;
        return view('issues.show',compact('issue','comments'));


/*        $issue = Issue::find($id);
        return view('issues.show',['issue'=>$issue]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
    public function edit(Issue $issue)
    {
//        $issue  = Issue::find($id);
        return view('issues.edit')->with('issue',$issue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
//        $issue = Issue::find($id);
        $issue->fill($request->all());
        $issue->save();

//        Return redirect()->route('issues.show',$id)->with('notice','修改成功');
        Return redirect()->route('issues.show',$issue->id)->with('notice','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
    public function destroy(Issue $issue)
    {
//        Issue::destroy($id);
        $issue->delete();
        return redirect('/')->with('alert','删除成功');
    }

}
