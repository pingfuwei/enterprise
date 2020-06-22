@extends('layout.mian')
@section('content')
    <table class="table">
      <h1>管理员添加</h1><h1 style="float: right" class="link_btn"><a href="/admin/admin/index" style="color: #ffffff">点击展示</a></h1>
    <ul class="ulColumn2">
            <li>
                <span class="item_name" style="width:120px;">名称：</span>
                <input type="text" class="textbox textbox_295" v-model="names"  placeholder="文本信息提示..."/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
                <span class="item_name" style="width:120px;">密码：</span>
                <input type="password" class="textbox textbox_295" v-model="pas" placeholder="文本信息提示..."/>
                {{--<span class="errorTips">错误提示信息...</span>--}}
            </li>
            <li>
                <span class="item_name" style="width:120px;"></span>
                <input type="button" class="link_btn" @click="send" value="添加管理员"/>
            </li>
    </ul>
    </table>
    <script>
        var vm=new Vue({
            el:".ulColumn2",
            data:{
                names:null,
                pas:null
            },
            methods:{
                send:function () {
                    var url="/admin/admin/createDo"
                    var date={names:vm.names,pas:vm.pas}
                    axios.post(url,date).then(function (res) {
                        console.log(res.data.font)
                        if(res.data.code==000){
                            location.href=res.data.url
                        }
                    })
                }
            }
        })
    </script>
@endsection