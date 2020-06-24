<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\adminModel\Category;
use App\adminModel\CategoryContent as caContent;


class CategoryContent extends Controller
{
    public function create(){
        $category=Category::get();
        $count=caContent::count();
        $count=$count+1;
        return view("admin.CategoryContent.create",["category"=>$category,"count"=>$count]);
    }
    public function createDo(){
        $data=\request()->all();
        $data["times"]=time();
        $res=caContent::insert($data);
        if($res){
            $arr=[
                "code"=>000,
                "font"=>"添加成功",
                "url"=>"index"
            ];
        }else{
            $arr=[
                "code"=>000,
                "font"=>"添加失败",
            ];
        }
        echo json_encode($arr);
    }
    public function index(){
        $res=caContent::join("category","category_content.cate_id","=","category.cate_id")->where("category_content.del",1)->orderBy("sorts","asc")->paginate(3);
        $count=caContent::count();
        $categoryCount=Category::count();
        $category=Category::get();
        return view("admin.CategoryContent.index",["res"=>$res,"count"=>$count,"categoryCount"=>$categoryCount,"category"=>$category]);
    }
    public function hidden(){//是否显示即点即改
        $data=\request()->is_show=="不显示"?1:0;
        $id=\request()->con_id;
        $res=caContent::where("con_id",$id)->update(["is_show"=>$data]);
        if($res){
            echo "ok";
        }
    }
    public function sort(){//排序即点即改
        $data=\request()->all();
        if($data["_val"]==$data["ord_val"]){
            echo "操作有误";
        }
//        var_dump($data);die;
        $data["con_id"]=intval($data["con_id"]);
        $aa=caContent::where("sorts",$data["_val"])->first();
        $res=caContent::where("con_id",$data["con_id"])->update(["sorts"=>$data["_val"]]);
        if($res){
            $res2=caContent::where("con_id",$aa->con_id)->update(["sorts"=>$data["ord_val"]]);
            if($res2){
                echo "ok";
            }
        }
    }
    //标题即点即改
    public function title(){
        $data=\request()->all();
        $res=caContent::where("con_id",$data["con_id"])->update(["title_name"=>$data["title_name"]]);
        if($res!==false){
            echo "ok";
        }
    }
    //来源的即点即改
    public function froms(){
        $data=\request()->all();
        $res=caContent::where("con_id",$data["con_id"])->update(["from"=>$data["from"]]);
        if($res!==false){
            echo "ok";
        }
    }
    //分类的即点即改
    public function categ(){
        $data=\request()->all();
//        $cate_id=Category::where("cate_name",$data["ord_val"])->first();
        $res=caContent::where("con_id",$data["con_id"])->update(["cate_id"=>$data["_val"]]);
        if($res){
            echo "ok";
        }
//        var_dump($data);
    }
    //删除
    public function del(){
        $id=\request()->all();
        $res=caContent::where("con_id",$id)->update(["del"=>0]);
        if($res){
            echo "ok";
        }
    }
    //修改
    public function upd(){
        $id=\request()->id;
        $info=caContent::where("con_id",$id)->first();
        return view("admin.CategoryContent.upd",["info"=>$info]);
    }
}
