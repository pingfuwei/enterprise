
@extends('layout.mian')
@section('content')
    <table class="table" id="app">
        <th colspan="6"><h1>普通分类展示 <a href="/admin/Category/create" style="float: right" class="link_btn">点击添加普通分类</a></h1></th>
        <tr>
            <th>id</th>
            <th>分类名称</th>
            <th>是否显示</th>
            <th>操作</th>
        </tr>
        @foreach($res as $v)
        <tr style="text-align: center">
            <td style="width:265px;"><div class="cut_title ellipsis">{{$v["cate_id"]}}</div></td>
        <td>{{$v["cate_name"]}}</td>
        <td><span id="hidden" cate_id="{{$v->cate_id}}">{{$v["hidden"]==1?"显示":"不显示"}}</span></td>
            <td>
                <button type="button" class="link_btn" cate_id="{{$v->cate_id}}" id="del"  style="background: #f83a3a;border: 0">删除</button>
                <button type="button" class="link_btn" cate_id="{{$v->cate_id}}" id="upd" >修改</button>
            </td>
        </tr>

        @endforeach
        <tr>
            <td colspan="4" class="aaa">{{$res->links()}}</td>
        </tr>
    </table>
    <script>
       $(document).on("click","#del",function () {//删除
           var id=$(this).attr("cate_id")
           if(confirm("是否删除")){
                $.ajax({
                    url:"/admin/Category/del",
                    data:{cate_id:id},
                    success:function (res) {
                        if(res=="ok"){
                            alert("删除成功")
                            location.href="/admin/Category/index"
                        }
                    }
                })
           }
       })
        $(document).on("click","#upd",function () {
            var id=$(this).attr("cate_id")
            if(confirm("是否修改")){
                location.href="/admin/Category/upd?id="+id
            }
        })
       $(document).on("click","#hidden",function () {//是否显示即点即改
           var data=$(this).text();
           if(data=="显示"){
               $(this).text("不显示")
           }else{
               $(this).text("显示")
           }
           var cate_id=$(this).attr("cate_id")
           $.ajax({
               url:"/admin/Category/hidden",
               data:{hidden:data,cate_id:cate_id},
               success:function (res) {
                   if(res=="ok"){
                       location.href="/admin/Category/index"
                   }
               }
           })
       })
    </script>
@endsection
