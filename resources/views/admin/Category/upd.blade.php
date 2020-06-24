
@extends('layout.mian')
@section('content')
    <center>
    <table class="table">
        <h1>普通分类修改</h1><h1 style="float: right" class="link_btn"><a href="/admin/Category/index" style="color: #ffffff">点击展示</a></h1>
        <ul class="ulColumn2">
            <input type="hidden" class="cate_id" value="{{$res->cate_id}}">
            <li>
                <span class="item_name" style="width:120px;">分类名称：</span>
                <input type="text" class="textbox textbox_295 aaa" v-model="cate_name"  value="{{$res->cate_name}}"/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
            <span class="item_name" style="width:120px;float: left;margin-left: 300px; ">是否显示：</span>
            <div style="float: left">
            <input type="radio" name="aa" class="hidden" value="1" {{$res->hidden==1?"checked":""}} >是
            <input type="radio" name="aa" class="hidden" value="0" {{$res->hidden==0?"checked":""}}>否
            </div>
            </li>
            <li style="float: left">
                <span class="item_name" style="width:120px;"></span>
                <input type="button" class="link_btn" @click="send" value="修改分类"/>
            </li>
        </ul>
    </table>
    </center>
    <style>
        .inputDisabled {
            cursor: not-allowed;
            /*color: #a29e9e!important;*/
            color: red;
            background: none!important;
        }
    </style>
    <script>
        var vm=new Vue({
            el:".ulColumn2",
            data:{
                cate_name:$(".aaa").val()
            },
            methods:{
                send:function () {
                    var url="updDo"
                    var hidden=$(".hidden:checked").val();
                    var cate_id=$(".cate_id").val();
                    var date={cate_name:vm.cate_name,hidden:hidden,cate_id:cate_id}
                    axios.post(url,date).then(function (res) {
                        alert(res.data.font)
                        if(res.data.code==000){
                            location.href=res.data.url
                        }
                    })
                }
            }
        })
    </script>
@endsection