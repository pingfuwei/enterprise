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
//后台路由
//->middleware("is_login")->
Route::prefix("admin")->group(function (){
    Route::any('index','admin\IndexController@index')->middleware("is_login");//首页
    Route::any('out','admin\LoginController@out')->middleware("is_login");//退出
    Route::any('login','admin\LoginController@login');//登陆展示
    Route::any('loginDo','admin\LoginController@loginDo');//登陆展示
    Route::prefix("admin")->middleware("is_login")->group(function (){//管理员分组
        Route::any('create','admin\AdminController@create');//添加展示
        Route::any('createDo','admin\AdminController@createDo');//添加执行
        Route::any('index','admin\AdminController@index');//展示
        Route::any('indexDo','admin\AdminController@indexDo');//展示执行
    });
    Route::prefix("Navigation")->middleware("is_login")->group(function (){//导航操作
        Route::any('create','admin\NavigationController@create');//添加展示
        Route::any('createDo','admin\NavigationController@createDo');//添加执行
        Route::any('index','admin\NavigationController@index');//展示
        Route::any('del','admin\NavigationController@del');//删除
        Route::any('upd/{id?}','admin\NavigationController@upd');//修改展示
        Route::any('show','admin\NavigationController@show');//显示ajax
        Route::any('sort','admin\NavigationController@sort');//排序ajax
    });
});