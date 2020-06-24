
@extends('layout.mian')
@section('content')
    <center>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <table class="table">
        <h1>普通分类内容添加</h1><h1 style="float: right" class="link_btn"><a href="/admin/CategoryContent/index" style="color: #ffffff">点击展示</a></h1>
        <ul class="ulColumn2">
            <li>
                <span class="item_name" style="width:100px;float: left;margin-left: 300px;">分类：</span>
                <select class="select" id="cate_id" style="margin-right: 500px;">
                    <option value="">选择分类</option>
                    @foreach($category as $k=>$v)
                        <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                        @endforeach
                </select>
            </li>
            <li>
                <span class="item_name" style="width:120px;">标题：</span>
                <input type="text" class="textbox textbox_295" id="title_name"   placeholder="文本信息提示..."/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
                <span class="item_name" style="width:120px;">来源：</span>
                <input type="text" class="textbox textbox_295" id="from"   placeholder="文本信息提示..."/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
                <span class="item_name" style="width:120px;">内容：</span>
                {{--<span class="errorTips">错误提示信息...</span>--}}
                <textarea name="" class="textbox textbox_295" placeholder="编写内容..." id="content" cols="30" rows="10"></textarea>
            </li>
            <li>
                <span class="item_name" style="width:120px;margin-left: 255px;">排序：</span>
                <input type="text" class="textbox textbox_295 inputDisabled" id="sorts" value="{{$count}}"   />
                <span class="errorTips">系统定义好的排序--列表改动排序...</span>
            </li>
            <li>
            <span class="item_name" style="width:120px;float: left;margin-left: 300px; ">是否显示：</span>
            <div style="float: left">
            <input type="radio" name="aa" class="is_show" value="1" checked>是
            <input type="radio" name="aa" class="is_show" value="0">否
            </div>
            </li>

            <li style="float: left">
                <span class="item_name" style="width:120px;"></span>
                <input type="button" class="link_btn" id="send" value="添加分类"/>
            </li>
        </ul>
    </table>
    </center>
    <style>
        .inputDisabled {
            cursor: not-allowed;
            /*color: #a29e9e!important;*/
            color: #000000;
            background: none!important;
        }
    </style>
    <script>
        $(document).on("click","#send",function () {
            var cate_id=$("#cate_id option:selected").val();//分类的id
            var title_name=$("#title_name").val();//标题
            var from=$("#from").val();
            var content=$("#content").val();
            var sorts=$("#sorts").val()
            var is_show=$(".is_show:checked").val();
            var date={cate_id:cate_id,title_name:title_name,from:from,content:content,sorts:sorts,is_show:is_show}
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "url":"/admin/CategoryContent/createDo",
                data:date,
                type:"post",
                dataType:"json",
                success:function (res) {
                    alert(res.font)
                    if(res.code==000){
                        window.location.href=res.url
                    }
                }
            })
        })
        $(function () {
            $(".inputDisabled").attr("disabled","false");
        })
    </script>
@endsection