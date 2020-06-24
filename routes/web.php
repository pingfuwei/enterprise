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
    Route::prefix("Category")->middleware("is_login")->group(function () {//普通分类操作
        Route::any('create','admin\CategoryController@create');//添加展示
        Route::any('createDo','admin\CategoryController@createDo');//添加展示执行
        Route::any('index','admin\CategoryController@index');//展示
        Route::any('hidden','admin\CategoryController@hidden');//是否显示即点即改
        Route::any('del','admin\CategoryController@del');//删除
        Route::any('upd/{id?}','admin\CategoryController@upd');//修改
        Route::any('updDo','admin\CategoryController@updDo');//修改执行
    });
    Route::prefix("CategoryContent")->middleware("is_login")->group(function () {//普通分类内容操作
        Route::any('create','admin\CategoryContent@create');//添加展示
        Route::any('createDo','admin\CategoryContent@createDo');//添加执行
        Route::any('index','admin\CategoryContent@index');//展示
        Route::any('del','admin\CategoryContent@del');//删除
        Route::any('hidden','admin\CategoryContent@hidden');//是否显示即点即改
        Route::any('sort','admin\CategoryContent@sort');//排序即点即改
        Route::any('title','admin\CategoryContent@title');//标题即点即改
        Route::any('froms','admin\CategoryContent@froms');//来源即点即改
        Route::any('categ','admin\CategoryContent@categ');//分类的即点即改
        Route::any('upd/{id?}','admin\CategoryContent@upd');//修改
    });
    Route::any('GuideCategory','admin\GuideCategory@GuideCategory');//图片
    Route::prefix("GuideCategory")->middleware("is_login")->group(function () {//指南分类操作
        Route::any('create','admin\GuideCategory@create');//添加展示
        Route::any('create','admin\GuideCategory@create');//图片
    });
});