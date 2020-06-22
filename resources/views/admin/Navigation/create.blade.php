
@extends('layout.mian')
@section('content')
    <center>
    <table class="table">
        <h1>导航添加</h1><h1 style="float: right" class="link_btn"><a href="/admin/Navigation/index" style="color: #ffffff">点击展示</a></h1>
        <ul class="ulColumn2">
            <li>
                <span class="item_name" style="width:120px;">导航名称：</span>
                <input type="text" class="textbox textbox_295" v-model="nav_name"  placeholder="文本信息提示..."/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
                <span class="item_name" style="width:120px;">导航地址：</span>
                <input type="text" class="textbox textbox_295"  id="nav_url" placeholder="文本信息提示..." />
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
                <span class="item_name" style="width:120px;">排序：</span>
                <input type="text" class="textbox textbox_295" v-model="nav_sort"  placeholder="文本信息提示..."/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
            <span class="item_name" style="width:120px;float: left;margin-left: 300px; ">是否显示：</span>
            <div style="float: left">
            <input type="radio" name="aa" class="nav_show" value="1">是
            <input type="radio" name="aa" class="nav_show" value="0">否
            </div>
            </li>
            <li style="float: left">
                <span class="item_name" style="width:120px;"></span>
                <input type="button" class="link_btn" @click="send" value="添加导航"/>
            </li>
        </ul>
    </table>
    </center>
    <script>
        var vm=new Vue({
            el:".ulColumn2",
            data:{
                nav_name:null,
                nav_sort:null
            },
            methods:{
                send:function () {
                    var url="createDo"
                    var nav_show=$(".nav_show:checked").val();
                    var nav_url=$("#nav_url").val();
                    var date={nav_name:vm.nav_name,nav_sort:vm.nav_sort,nav_show:nav_show,nav_url:nav_url}
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