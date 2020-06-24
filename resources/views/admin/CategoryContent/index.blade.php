
@extends('layout.mian')
@section('content')
    <input type="hidden" id="aaa" value="">
    <input type="hidden" id="bbb" value="">
    <table class="table" id="app">
        <th colspan="8"><h1>普通分类内容展示 <a href="/admin/CategoryContent/create" style="float: right" class="link_btn">点击添加普通分类内容</a></h1></th>
        <tr>
            <th>id</th>
            <th>分类名称</th>
            <th>文章标题</th>
            <th>来源</th>
            <th>内容</th>
            <th>是否显示</th>
            <th>排序</th>
            <th>操作</th>

        </tr>
        <div id="div_names">
        <select name="" id="sele_names" style="display: none">
            <option value="">请选择</option>
            @foreach($category as $k=>$v)
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
            @endforeach
        </select>
        </div>
        @foreach($res as $v)
        <tr style="text-align: center">
            <td >{{$v["con_id"]}}</td>
            <td>
                <span id="cate_name" con_id="{{$v->con_id}}">{{$v["cate_name"]}}</span>
            </td>
            <td>
                <span id="title_name">{{$v["title_name"]}}</span>
                <input type='text' id="title_span" value="{{$v["title_name"]}}" style="display: none" con_id="{{$v->con_id}}">
            </td>
            <td>
                <span id="from">{{$v["from"]}}</span>
                <input type='text' id="from_span" value="{{$v["from"]}}" style="display: none" con_id="{{$v->con_id}}">
            </td>
            <td align="center"   title="${entity.newsTitle }"  style="max-width: 100px;overflow: hidden; text-overflow:ellipsis;white-space: nowrap">{{$v["content"]}}</td>
            <td><span id="hidden" con_id="{{$v->con_id}}">{{$v["is_show"]==1?"显示":"不显示"}}</span></td>
            <td><span id="sort" con_id="{{$v->con_id}}">{{$v["sorts"]}}</span></td>
            <td>
                <button type="button" class="link_btn" con_id="{{$v->con_id}}" id="del"  style="background: #f83a3a;border: 0">删除</button>
                <button type="button" class="link_btn" con_id="{{$v->con_id}}" id="upd" >修改</button>
            </td>
        </tr>

        @endforeach
        <tr>
            <td colspan="8" class="aaa">{{$res->links()}}</td>
        </tr>
    </table>
    <script>
        //删除
       $(document).on("click","#del",function () {//删除
           var id=$(this).attr("con_id")
           if(confirm("是否删除")){
                $.ajax({
                    url:"/admin/CategoryContent/del",
                    data:{con_id:id},
                    success:function (res) {
                        if(res=="ok"){
                            alert("删除成功")
                            location.href="/admin/CategoryContent/index"
                        }
                    }
                })
           }
       })
        //修改
        $(document).on("click","#upd",function () {
            var id=$(this).attr("con_id")
            if(confirm("是否修改")){
                location.href="/admin/CategoryContent/upd?id="+id
            }
        })
       $(document).on("click","#hidden",function () {//是否显示即点即改
           var data=$(this).text();
           if(data=="显示"){
               $(this).text("不显示")
           }else{
               $(this).text("显示")
           }
           var con_id=$(this).attr("con_id")
           $.ajax({
               url:"/admin/CategoryContent/hidden",
               data:{is_show:data,con_id:con_id},
               success:function (res) {
                   if(res=="ok"){
                       location.href="/admin/CategoryContent/index"
                   }
               }
           })
       })
       $(document).on("click","#sort",function () {//排序即点即改
           var _class=$(".option").prop("class")
           if(_class=="option"){
               alert("操作有误")
               return
           }
           $(this).hide()
           var count="{{$count+1}}"
           var opti="<option >  请选择</option>"
           for (var i=1;i<count;i++){
               opti +="<option  value="+i+"> "+i+" </option>"
           }
           var aa="<div class='option' ><select  id='sort_s' > "+opti +"</select></div>"
           $(this).parent().append(aa)
       })
       $(document).on("change","#sort_s",function () {//排序即点即改
           var _val=$("#sort_s option:selected").val()
           var ord_val=$(".option").prev().text()
           var con_id=$(".option").prev().attr("con_id")
           $.ajax({
               url:"/admin/CategoryContent/sort",
               data:{_val:_val,ord_val:ord_val,con_id:con_id},
               success:function (res) {
                   if(res=="ok"){
                       location.href="/admin/CategoryContent/index"
                   }else{
                       alert(res)
                       location.href="/admin/CategoryContent/index"
                   }
               }
           })
       })
        //标题的jquery
       $(document).on("click","#title_name",function () {
          var aaa=$("#aaa").val()
            if(aaa=="1"){
              alert("操作有误")
                return
            }
           $(this).hide();
           $(this).next().show()
           $("#aaa").val(1)

       })
       //标题的jquery
       $(document).on("blur","#title_span",function () {
           var con_id=$(this).attr("con_id")
           var title_name=$(this).val();
           var url="/admin/CategoryContent/title";
           var date={con_id:con_id,title_name:title_name}
           jdjg(date,url)
       })
        //来源的jquery
       $(document).on("click","#from",function () {
           var aaa=$("#bbb").val()
           if(aaa=="1"){
               alert("操作有误")
               return
           }
           $(this).hide();
           $(this).next().show()
           $("#bbb").val(1)
       })
       //来源的jquery
       $(document).on("blur","#from_span",function () {
           var con_id=$(this).attr("con_id")
           var froms=$(this).val();
           var url="/admin/CategoryContent/froms";
           var date={con_id:con_id,from:froms}
           jdjg(date,url)
       })
        //分类名称的jquery
       $(document).on("click","#cate_name",function () {//分类即点即改
           var _class=$(".sele_names").prop("class")
           if(_class=="sele_names"){
               alert("操作有误")
               location.href="/admin/CategoryContent/index"
               return
           }
           $(this).hide()
           var sele_name=$("#div_names").html()
           $(this).parent().append(sele_name);
           $(this).next().show()
           $(this).next().attr("class","sele_names")

       })
       $(document).on("change",".sele_names",function () {//分类即点即改
           var _val=$(".sele_names option:selected").val()
           var __val=$(".sele_names option:selected").text()
           $(".sele_names").hide()
           $(".sele_names").prev().show().text(__val)
           var ord_val=$(".sele_names").prev().text()
           var con_id=$(".sele_names").prev().attr("con_id")

           $.ajax({
               url:"/admin/CategoryContent/categ",
               data:{_val:_val,ord_val:ord_val,con_id:con_id},
               success:function (res) {
                   if(res=="ok"){
                       location.href="/admin/CategoryContent/index"
                   }else{
//                       alert(res)
                       location.href="/admin/CategoryContent/index"
                   }
               }
           })
       })
       function jdjg(date,url) {
            $.ajax({
                url:url,
                data:date,
                success:function (res) {
                    if(res=="ok"){
                        location.href="/admin/CategoryContent/index"
                    }
                }

            })
        }
    </script>
@endsection
