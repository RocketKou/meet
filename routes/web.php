<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/','WelcomeController@index');
Route::get('/about','WelcomeController@about');

/*//CRUD增加
//create显示增加页面
Route::get('/issues/create','IssuesController@create')->name('issues.create');
//store存储增加页面
Route::post('/issues','IssuesController@store')->name('issues.store');

//CURD修改
Route::get('/issues/{issue}/edit','IssuesController@edit')->name('issues.edit');
Route::put('/issues/{issue}', 'IssuesController@update')->name('issues.update');

//CRUD的查,查询一条
Route::get('/issues/{issue}','IssuesController@show')->name('issues.show');

//CRUD的删,因为是delete请求，所以不用担心顺序问题造成访问其它的路径访问到这个上面
Route::delete('/issues/{issue}','IssuesController@destroy')->name('issues.destroy');

//CURD查，查询多条
Route::get('/issues','IssuesController@index')->name('issues.index');*/

Route::resource('issues','IssuesController');

Route::post('comments/store','CommentsController@store',['only'=>'store'])->name('comments.store');








