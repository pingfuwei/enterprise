@extends('layout.mian')
@section('content')
    <table class="table" id="app">
        <th colspan="6"><h1>管理员展示 <a href="/admin/admin/create" style="float: right" class="link_btn">点击添加</a></h1></th>
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>密码</th>
        </tr>
            <tr style="text-align: center" v-for="v in res">
                <td style="width:265px;"><div class="cut_title ellipsis">@{{v["id"]}}</div></td>
                <td>@{{v["names"]}}</td>
                <td>@{{v["pas"]}}</td>
            </tr>
    </table>
    <script>
        var vm=new Vue({
            el:"#app",
            data:{
                res:null
            },
            mounted(){
                var url="/admin/admin/indexDo"
                axios.post(url).then(function (res) {
                    vm.res=res.data
                    console.log(res.data)
                })
            }
        })
    </script>
@endsection