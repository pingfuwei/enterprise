<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminModel\Admin;
class LoginController extends Controller
{
    public function login(){
        return view("admin.login.login");
    }
    public function loginDo(){
        $data=\request()->all();
        $info=Admin::where("names",$data["names"])->first();
        if($info){
            if($info->pas!=md5($data["pas"])){
                $arr=[
                    "code"=>111,
                    "font"=>"密码或者账号错误"
                ];
            }else{
                $arr=[
                    "code"=>000,
                    "font"=>"登陆成功",
                    "url"=>"/admin/index"
                ];
                session(["user"=>$info->names]);
            }

        }else{
            $arr=[
                "code"=>111,
                "font"=>"密码或者账号错误"
            ];
        }
        echo json_encode($arr);
    }
    public function out(){
        session(["user"=>null]);
      return  redirect("admin/login");
    }
}
