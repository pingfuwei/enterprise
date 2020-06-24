<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideCategory extends Controller
{
    public function create(){
        return view("admin.GuideCategory.create");
    }
    //图片
    public function GuideCategory(){
            $file=$_FILES["file_upload"];
//            $entension = $file->getClientOriginalExtension();//获取文件名后缀
            echo $file;

    }
}
