
@extends('layout.mian')
@section('content')
    <table class="table" id="app">
        <th colspan="6"><h1>导航展示 <a href="/admin/Navigation/create" style="float: right" class="link_btn">点击添加导航</a></h1></th>
        <tr>
            <th>id</th>
            <th>导航名称</th>
            <th>是否显示</th>
            <th>排序</th>
            <th>网址</th>
            <th>操作</th>
        </tr>
        @foreach($res as $v)
        <tr style="text-align: center" nav_id="{{$v->nav_id}}">
            <td style="width:265px;"><div class="cut_title ellipsis">{{$v["nav_id"]}}</div></td>
        <td>{{$v["nav_name"]}}</td>
        <td><span id="nav_show" nav_id="{{$v->nav_id}}">{{$v["nav_show"]==1?"显示":"不显示"}}</span></td>
        <td>
            <span id="sort" nav_id="{{$v->nav_id}}">{{$v["nav_sort"]}}</span>
        </td>
            <td>{{$v["nav_url"]}}</td>
            <td>
                <button type="button" class="link_btn" nav_id="{{$v->nav_id}}" id="del"  style="background: #f83a3a;border: 0">删除</button>
                <button type="button" class="link_btn" nav_id="{{$v->nav_id}}" id="upd" >修改</button>
            </td>
        </tr>

        @endforeach
        <tr>
            <td colspan="6" class="aaa">{{$res->links()}}</td>
        </tr>
    </table>
    <style>
        .aaa ul{
            margin-left: 40%;

        }
        .aaa ul li .page-link{
            float: left;
            margin-left: 10px;
            width: 17px;
            height: 20px;
            background: #5bc0de;
            line-height: 20px;
            padding-left: 8px;
            color: #ffffff;
        }
    </style>
    <script>
       $(document).on("click","#del",function () {
           var id=$(this).attr("nav_id")
           if(confirm("是否删除")){
                $.ajax({
                    url:"/admin/Navigation/del",
                    data:{nav_id:id},
                    success:function (res) {
                        if(res=="ok"){
                            alert("删除成功")
                            location.href="/admin/Navigation/index"
                        }
                    }
                })
           }
       })
        $(document).on("click","#upd",function () {
            var id=$(this).attr("nav_id")
            if(confirm("是否修改")){
                location.href="/admin/Navigation/upd?id="+id
            }
        })
        $(document).on("click","#nav_show",function () {
            var data=$(this).text();
            if(data=="显示"){
                $(this).text("不显示")
            }else{
                $(this).text("显示")
            }
            var nav_id=$(this).attr("nav_id")
            $.ajax({
                url:"/admin/Navigation/show",
                data:{nav_show:data,nav_id:nav_id},
                success:function (res) {
                    if(res=="ok"){
                        location.href="/admin/Navigation/index"
                    }
                }
            })
        })
        $(document).on("click","#sort",function () {
            $(this).hide()
            var count="{{$count+1}}"
            var opti="<option >  请选择</option>"
            for (var i=1;i<count;i++){
                  opti +="<option  value="+i+"> "+i+" </option>"
            }
            var aa="<select  id='sort_s' > "+opti +"</select>"
            $(this).parent().append(aa)
//            $(this).next().show()

        })
       $(document).on("change","#sort_s",function () {
           var _val=$("#sort_s option:selected").val()
           var ord_val=$("#sort_s").prev().text()
           var nav_id=$("#sort_s").prev().attr("nav_id")
           $.ajax({
               url:"/admin/Navigation/sort",
               data:{_val:_val,ord_val:ord_val,nav_id:nav_id},
               success:function (res) {
                   if(res=="ok"){
                       location.href="/admin/Navigation/index"
                   }else{
                       alert(res)
                       location.href="/admin/Navigation/index"
                   }
               }
           })
       })
    </script>
@endsection
