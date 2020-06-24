<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminModel\Category;
class CategoryController extends Controller
{
    public function create(){
        return view("admin.Category.create");
    }
    public function createDo(){
        $data=\request()->all();
        $data["hidden"]=intval($data["hidden"]);
        $data["cate_time"]=time();
        $info=Category::where("cate_name",$data["cate_name"])->first();
        if($info){
            $arr=[
                "code"=>111,
                "font"=>"该分类已有",
            ];
            echo json_encode($arr);die;
        }
        $res=Category::insert($data);
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
        $res=Category::where("del",1)->paginate(2);
        return view("admin.Category.index",["res"=>$res]);
    }
    public function hidden(){
        $data=\request()->hidden=="不显示"?1:0;
        $id=\request()->cate_id;
        $res=Category::where("cate_id",$id)->update(["hidden"=>$data]);
        if($res){
            echo "ok";
        }
    }
    public function del(){
        $id=\request()->all();
        $res=Category::where("cate_id",$id)->update(["del"=>0]);
        if($res){
            echo "ok";
        }
    }
    public function upd(){
        $id=\request()->id;
        $res=Category::where("cate_id",$id)->first();
        return view("admin.Category.upd",["res"=>$res]);
    }
    public function updDo(){
        $data=\request()->all();
        unset($data["cate_id"]);
        $id=\request()->cate_id;
        $res=Category::where("cate_id",$id)->update($data);
        if($res){
            $arr=[
                "code"=>000,
                "font"=>"修改成功",
                "url"=>"index"
            ];
        }else{
            $arr=[
                "code"=>000,
                "font"=>"修改失败",
                "url"=>"index"
            ];
        }
        echo json_encode($arr);
    }
}
