<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminModel\Navigation;
class NavigationController extends Controller
{
    public function create(){
        $count=Navigation::where("nav_del",1)->count();
        $count=$count+1;
        return view("admin.Navigation.create",["count"=>$count]);
    }
    public function createDo(){
        $data=\request()->all();
        $count=Navigation::where("nav_del",1)->count();
        $count=$count+1;
        $data["nav_sort"]=$count;
        $data["nav_time"]=time();
        $res=Navigation::insert($data);
        if($res){
            $arr=[
                "code"=>000,
                "font"=>"添加成功",
                "url"=>"index"
            ];
        }else{
            $arr=[
                "code"=>111,
                "font"=>"添加失败",
            ];
        }
        echo json_encode($arr);
    }
    public function index(){
        $res=Navigation::orderBy("nav_sort","asc")->where("nav_del",1)->paginate(3);
        $count=Navigation::get()->count();
        return view("admin.Navigation.index",["res"=>$res,"count"=>$count]);
    }
    public function del(){
       $id=\request()->all();
        $res=Navigation::where("nav_id",$id)->update(["nav_del"=>0]);
        if($res){
            echo "ok";
        }
    }
    public function upd(){
        if(\request()->isMethod("get")){
            $count=Navigation::where("nav_del",1)->count();
//            $count=$count+1;
            $id=\request()->id;
            $res=Navigation::where("nav_id",$id)->first();
            return view("admin.Navigation.upd",["res"=>$res,"count"=>$count]);
        }else{
            $data=\request()->all();
            $data["nav_id"]=intval($data["nav_id"]);
//            $count=Navigation::where("nav_del",1)->count();
//            $data["nav_sort"]=$count;
            $res=Navigation::where("nav_id",$data["nav_id"])->update($data);
            if($res){
                echo "ok";
            }else{
                echo $res;
            }
        }

    }
    public function show(){
        $data=\request()->nav_show=="不显示"?1:0;
        $id=\request()->nav_id;
        $res=Navigation::where("nav_id",$id)->update(["nav_show"=>$data]);
        if($res){
            echo "ok";
        }
    }
    public function sort(){
        $data=\request()->all();
        if($data["_val"]==$data["ord_val"]){
            echo "操作有误";
        }
        $data["nav_id"]=intval($data["nav_id"]);
        $aa=Navigation::where("nav_sort",$data["_val"])->first();
        $res=Navigation::where("nav_id",$data["nav_id"])->update(["nav_sort"=>$data["_val"]]);
        if($res){
            $res2=Navigation::where("nav_id",$aa->nav_id)->update(["nav_sort"=>$data["ord_val"]]);
            if($res2){
                echo "ok";
            }
        }
    }
}
