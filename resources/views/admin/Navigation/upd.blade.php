
@extends('layout.mian')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <center>
        <table class="table">
            <h1>导航修改</h1><h1 style="float: right" class="link_btn"><a href="/admin/Navigation/index" style="color: #ffffff">点击展示</a></h1>
            <input type="hidden" id="nav_id" value="{{$res->nav_id}}">
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">导航名称：</span>
                    <input type="text" class="textbox textbox_295" id="nav_name"   value="{{$res->nav_name}}" />
                    {{--<span class="errorTips">错误提示信息...</span>--}}
                </li>
                <li>
                    <span class="item_name" style="width:120px;">导航地址：</span>
                    <input type="text" class="textbox textbox_295"  id="nav_url"  value="{{$res->nav_url}}" />
                    {{--<span class="errorTips">错误提示信息...</span>--}}
                </li>
                <li>
                    <span class="item_name" style="width:120px;">排序：</span>
                    <input type="text" class="textbox textbox_295 inputDisabled ww" id="nav_sort" v-model="nav_sort"  value="{{$count}}"/>
                    {{--<span class="errorTips">错误提示信息...</span>--}}
                </li>
                <li>
                    <span class="item_name" style="width:120px;float: left;margin-left: 300px; ">是否显示：</span>
                    <div style="float: left">
                        <input type="radio" name="aa" class="nav_show" {{$res->nav_show==1?"checked":""}} value="1">是
                        <input type="radio" name="aa" class="nav_show" {{$res->nav_show==0?"checked":""}} value="0">否
                    </div>
                </li>
                <li style="float: left">
                    <span class="item_name" style="width:120px;"></span>
                    <input type="button" class="link_btn" id="send" value="修改导航"/>
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
        var nav_name=$("#nav_name").val();
            var nav_id=$("#nav_id").val();
//            alert(nav_id)
            var nav_url=$("#nav_url").val();
        var nav_sort=$("#nav_sort").val();
        var nav_show=$(".nav_show:checked").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"upd",
                data:{nav_name:nav_name,nav_sort:nav_sort,nav_show:nav_show,nav_url:nav_url,nav_id:nav_id},
                type:"post",
                success:function (res) {
                 if(res=="ok"){
                     alert("修改成功")
                     location.href="index"
                 }
                }
            })
        })
    $(function () {
        $(".inputDisabled").attr("disabled","false");
    })
    </script>
@endsection