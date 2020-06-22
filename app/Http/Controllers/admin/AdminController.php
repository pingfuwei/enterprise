<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminModel\Admin;

class AdminController extends Controller
{
    //管理员添加
    public function create(){
        return view("admin.admin.create");
    }
    //添加执行
    public function createDo(){
        $data=\request()->all();
        $data["pas"]=md5($data["pas"]);
        $res=Admin::insert($data);
        if($res){
            $arr=[
                "font"=>"添加成功",
                "code"=>000,
                "url"=>"/admin/admin/index"
            ];
        }else{
            $arr=[
                "font"=>"添加失败",
                "code"=>111,
            ];
        }
        echo json_encode($arr);
    }
    //管理员展示
    public function index(){

            return view("admin.admin.index");
    }
    //管理员展示接口
    public function indexDo(){
        $res=Admin::get();
        echo  json_encode($res);
    }
}
